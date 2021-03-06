'''
Will connect to an IMAP, get an email and send it to a URI
'''
#!/usr/bin/python

import imaplib, re, email, datetime, os, time, smtplib, validate, sys
sys.path.append("/usr/local/lib/python")
import logging, daemon
from email.Parser import Parser
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email.MIMEText import MIMEText
from email.Utils import COMMASPACE, formatdate
from email import Encoders

loopDelay = 30 # seconds

class habwatchEPDaemon(daemon.Daemon):
    default_conf = './habwatchpd.conf'
    section = 'habwatchpd'
    def run(self):
        logging.info("habwatch Email Parser Daemon is starting up")
        
        while 1:
            logging.info("refresh loop started")
            before = time.time()
            refresh()
            after = time.time()
            duration = after - before
            logging.info("refresh loop completed")
            logging.info("duration: %.2f seconds" % duration)
            logging.info("sleeping for %.2f seconds" % loopDelay)
            time.sleep(loopDelay)

def refresh():
    try:
        epo = emailparser("imap.gmail.com", 993, "m@habwatch.com", "CENSMERHAB", "Inbox", "smtp.gmail.com", 587, "press22upon@photos.flickr.com")
        epo.process()
    except:
        logging.info("Had a problem with email parsing")
        pass

class emailparser:
    def __init__(self,emailserver,emailport,emaillogin,emailpassword,emailbox,smtpserver,smtpport,smtpaddress):

        self.emailserver = emailserver
        self.emailport = emailport
        self.smtpserver = smtpserver
        self.smtpport = smtpport
        self.smtpaddress = smtpaddress
        self.emaillogin = emaillogin
        self.emailpassword = emailpassword
        self.emailbox = emailbox

    def getusername(self, emailaddy):
        # Get the userame
        username = emailaddy.split("@")
        return username[0]

    def process(self):
        logging.info("Attempting to process: %s" % datetime.datetime.now().strftime("%Y-%m-%d_%H:%M:%S"))
        
        imapconn = imaplib.IMAP4_SSL(self.emailserver, self.emailport)
        smtpconn = smtplib.SMTP(self.smtpserver, self.smtpport)
        smtpconn.ehlo()
        smtpconn.starttls()
        smtpconn.ehlo()
        
        try:
            imapconn.login(self.emaillogin, self.emailpassword)
            smtpconn.login(self.emaillogin, self.emailpassword)
        except:
            imapconn.close()
            imapconn.logout()
            smtpconn.quit()
            logging.info("habwatch Email Login Problem")
            return
        
        try:
            status, count = imapconn.select(self.emailbox)
        except:
            imapconn.close()
            imapconn.logout()
            smtpconn.quit()
            logging.info("habwatch Email Select Problem")
            return
        
        try:
            status, messages = imapconn.search(None, "(UNSEEN)")
        except:
            imapconn.close()
            imapconn.logout()
            smtpconn.quit()
            logging.info("habwatch Email Search Problem")
            return
        
        deleteme = []
        
        if status == 'OK':
            p = Parser()
            
            for message in messages[0].split():
                emailaddy = ""
                emaildt = ""
                emaildate = ""
                emailhtml = ""
                emailsubject = ""
                emailtext = ""
                emaillocation = ""
                imgfilename = ""
                imgpart = ""
                username = ""
                
                logging.info('Processing: %s' % message)
                try:
                    status, data = imapconn.fetch(message, '(BODY[HEADER.FIELDS (DATE SUBJECT FROM)])')
                except:
                    imapconn.close()
                    imapconn.logout()
                    smtpconn.quit()
                    logging.info("habwatch Email Fetch Problem")
                    return
                
                msg = p.parsestr(data[0][1])
                when = msg.__getitem__('Date')
                who = msg.__getitem__('From')
                subject = msg.__getitem__('Subject')
                matchemail = re.compile(r'[\w\-][\w\-\.]+@[\w\-][\w\-\.]+[a-zA-Z]{1,4}')
                emailaddy = matchemail.findall(who)[0]
                
                username = self.getusername(emailaddy)
                
                # take care of stupid no leading zero problem
                if(when[6] == " "):
                    when = when[0:5]+"0"+when[5:]
                
                emaildate = datetime.datetime(*time.strptime(when[5:16], "%d %b %Y")[0:6]).strftime("%Y-%m-%d")
                logging.info('when: %s' % when)
                emaildt = datetime.datetime(*time.strptime(when[5:25], "%d %b %Y %H:%M:%S")[0:6]).strftime("%Y-%m-%d %H:%M:%S")
                emailsubject = subject
                
                try:
                    status, data = imapconn.fetch(message, '(RFC822)')
                except:
                    imapconn.close()
                    imapconn.logout()
                    smtpconn.quit()
                    logging.info("habwatch Email Fetch 2 Problem")
                    return
                
                emailbody = data[0][1]
                
                validtext = False
                validhtml = False
                validimg = False
                
                emailmsg = email.message_from_string(emailbody)
                for part in emailmsg.walk():
                    type = part.get_content_type()
                    payload = part.get_payload()
                    payload = part.get_payload(decode=1)
                    filename = part.get_filename()
                    multipart = part.is_multipart()
                    
                    # TYPES INCLUDE:
                    # type multipart/mixed
                    # type multipart/alternative
                    # type text/plain
                    # type text/html
                    # type image/jpeg
                    
                    if(multipart):
                        continue
                    
                    if(type == 'text/plain'):
                        emailtext = payload
                        validtext = True
                    
                    if(type == 'text/html'):
                        emailhtml = payload
                        validhtml = True
                    
                    if((type == 'image/gif') or (type == 'image/jpeg') or (type == 'image/png')):
                        if(validimg == True):
                            continue
                        else:
                            imgpart = part
                            imgfilename = filename
                            logging.info('imgfilename: %s' % imgfilename)
                            validimg = True
                    
                    # Just one image per user son!
                    if(validimg):
                        break
                
                logging.info("Username: %s" % username)
                logging.info("Email Address: %s" % emailaddy)
                logging.info("Email DT: %s" % emaildt)
                logging.info("Email Date: %s" % emaildate)
                logging.info("Email Subject: %s" % emailsubject)
                logging.info("Email Text: %s" % emailtext)
                logging.info("Email HTML: %s" % emailhtml)
                logging.info("IMG FileName: %s" % imgfilename)
                
                # Send it out
                if(validimg and (not validate.spam(emailaddy))):
                    try:
                        msg = MIMEMultipart()
                        msg['From'] = self.emaillogin
                        msg['To'] = self.smtpaddress
                        msg['Date'] = formatdate(localtime=True)
                        # replace this
                        msg['Subject'] = "photo tags: %s %s" % (username, subject or '')
                        msg.attach(MIMEText("%s\n\n- Camera phone upload powered by HAB Watch" % emailtext))
                        msg.attach(imgpart)
                        
                        smtpconn.sendmail(self.emaillogin, self.smtpaddress, msg.as_string())
                        logging.info("Sent to Flickr")
                        
                        #Change this so that things get deleted or not
                        deleteme.append(message)
                        logging.info('%s %s %s sent to Flickr' % (username, emailaddy, emaildt))
                    
                    except:
                        logging.info("Exception to Sending Email")
                        pass
                else:
                    logging.info('%s %s %s deleted' % (username, emailaddy, emaildt))
                    
                    deleteme.append(message)
                    logging.info("Invalid Img or User")
            
            if deleteme:
                deleteme.sort()
                deleteme.reverse()
                for message in deleteme:
                    try:
                        imapconn.store(message, '+FLAGS', '(\\Deleted)')
                        imapconn.expunge()
                    except:
                        imapconn.close()
                        imapconn.logout()
                        smtpconn.quit()
                        logging.info("habwatch Email Delete Problem")
                        return
        imapconn.close()
        imapconn.logout()
        smtpconn.quit()

if __name__ == '__main__':
    habwatchEPDaemon().main()

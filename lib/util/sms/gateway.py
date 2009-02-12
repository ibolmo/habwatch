import inbox, appuifw, e32, messaging, httplib, socket, urllib, time

# Setup for T-Mobile
apo = socket.access_point(2)
socket.set_default_access_point(apo)

# Domain info
domain = "dev.habwatch.com"
handler = "/sms"
keyword = "m@habwatch.com"

print "SMS Gateway Started"
print "Domain is:", domain
print "Handler is:", handler

def createdtstring(secs, format):
    return time.strftime(format,(time.localtime(secs)))

while 1:
    box = inbox.Inbox()
    msgs = box.sms_messages()

    for i in msgs:
        address = str(box.address(i))
        epoch = int(box.time(i))
        content = str(box.content(i))
        
        if(content.find(keyword) != -1):
            info = content.split(" / ")
            number = info[1]
            msg = info[2]
            
            if(len(number) == 10):
                if(len(msg) > 160):
                    msg = msg[0:160]
                
                print "Sending SMS to Number"
                print "Number: ", number
                print "Content: ", content                
                
                messaging.sms_send(number, msg)
            else:
                print "Something wrong with SMS to Number"
    
            box.delete(i)
    
        else:
            print 'Forwarding SMS to Email'
            sms_text = '%s:%s:%s' % (address, epoch, content)
            print 'Handeling SMS message %s with message: %s' % (i, sms_text)
            box.delete(i)
    
            # Lets handle emails
            address = address.replace("+1", "")
            
            # This handles when participants send an email to yourPhoneNumber@yourService.tld
            if(len(address) != 10):
                info = content.split(" / ")
    
                if(len(info) == 3):
                    address = info[0]
                    content = info[1] + " / " + info[2]
                elif(len(info) == 2):
                    address = info[0]
                    content = info[1]
                else:
                    continue
            
            args = '/%s/%s/' % (address, urllib.quote(content))
            
            try:
                conn = httplib.HTTPConnection(domain)
                print "GET: %s" % (handler + args)
                conn.request("GET", handler+args)
                response = conn.getresponse()
                
                output = response.read()
                print response.status, response.reason, output
                conn.close()
            except:
                print 'An error occurred'
                continue

    e32.ao_sleep(5)


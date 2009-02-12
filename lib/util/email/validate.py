import os, time, datetime
from pysqlite2 import dbapi2 as sqlite

def spam(user):

    user=user.replace("\r\n", "")
    user=user.replace("\r", "")
    user=user.replace("\n", "")

    users = []

    con = sqlite.connect('/opt/database/habwatch.sqlite3')
    cur = con.cursor()

    cur.execute("SELECT * from spam")
    rows = cur.fetchall()

    cur.close()
    con.close()

    for row in rows:
        users.append(str(row[0]))

    if user in users:
        return True
    else:
        return False
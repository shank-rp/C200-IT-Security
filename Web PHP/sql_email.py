import mysql.connector
import smtplib
import sys


def email(sender, msg):
    email_addr = "test.email.log.entry@gmail.com"
    passw = "test_em@il1"

    with smtplib.SMTP("smtp.gmail.com", 587) as smtp:
        smtp.ehlo()
        smtp.starttls()
        smtp.ehlo()

        smtp.login(email_addr, passw)
        subject = "GOTTEM History Receipt"
        msg = 'Subject: ' + subject + '\n\n' + msg

        smtp.sendmail(email_addr, sender, msg)
        print("Email Sent!!")




mydb = mysql.connector.connect(host="localhost", user="root",passwd="", database="c200_web")

mycursor = mydb.cursor()
try:
    mycursor.execute("SELECT date, item_name, price, address, email_address FROM receipt R INNER JOIN account A ON R.user_id = A.user_id INNER JOIN product P ON P.product_id = R.product_id WHERE username=\'" + "" + "\'")
except:
    print("Please enter your username")
    exit()
myResult = mycursor.fetchall()


if not myResult:
    print("Inavlid Username/No History Purchase Found")
else:
    print('run')
    msg = "{0:8} {1:23} {2:24} {3:17} {4}".format("No.", "Date", "Product", "Price", "Address\n")
    msg += "-"*85 + "\n"
    for idx, row in enumerate(myResult):
        msg += "{0:10} {1:17} {2:25} {3:15} {4}".format(str(idx + 1), str(row[0]), row[1], "$" + str(row[2]), row[3] + "\n")
    sender_email = myResult[0][4]
    email(sender_email, msg)

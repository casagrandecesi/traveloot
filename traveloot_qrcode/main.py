from datetime import datetime
from hashlib import sha256
from sys import exit
from urllib.parse import quote

from PIL import ImageTk, Image
import qrcode
import tkinter

from settings import NAME, PASSWORD, URL

prev_now_str = ""

def create_qrcode(now_str):
    src = now_str + "|" + PASSWORD
    print(src)
    m = sha256()
    m.update(src.encode())
    digest = m.hexdigest()
    url = f"{URL}?name={quote(NAME)}&digest={quote(digest)}"
    print(url)
    img = qrcode.make(url)
    img.save("qrcode.png")
    return now_str


def update_qrcode():
    global prev_now_str, l3, window
    now = datetime.utcnow()
    now_str = now.strftime('%Y-%m-%d_%H-%M')
    if now_str == prev_now_str:
        window.after(1000, update_qrcode)
        return
    print("----------------> UPDATE")
    create_qrcode(now_str)
    prev_now_str = now_str
    w = l3.winfo_width()
    h = l3.winfo_height()
    s = min(w, h)
    img_orig = Image.open("qrcode.png")
    img = img_orig.resize((s, s))
    imgtk = ImageTk.PhotoImage(img)
    l3.config(image=imgtk)
    l3.image = imgtk
    l3.pack(expand=1, fill='both')
    window.update()
    window.after(1000, update_qrcode)


def key_handler(event):
    if event.char == 'q':
        exit(0)
    

# Main code

window = tkinter.Tk()
window.attributes("-fullscreen", True)
window.config(bg="white")
window.bind("<Key>", key_handler)
logo = Image.open("logo-horiz.png")
logotk = ImageTk.PhotoImage(logo)
l0 = tkinter.Label(window, image=logotk, bg="white")
l0.pack(fill='x')
l1 = tkinter.Label(window, text=NAME, bg="white", fg="#1bbc9b")
l1.config(font=('Arial', 48, 'bold'))
l1.pack(fill='x', pady=25)
l3 = tkinter.Label(window, text="Loading...")
l3.config(bg="white")
l3.pack(expand=1, fill='both')
window.update()

window.after_idle(update_qrcode)
window.mainloop()
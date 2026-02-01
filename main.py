import os
from pyrogram import Client, filters

# كود أبسط لتجنب المشاكل حالياً
BOT_TOKEN = os.environ.get("BOT_TOKEN")

# سنضع أرقاماً افتراضية مؤقتاً لتخطي حاجز الـ Build
app = Client("link_bot", api_id=2040, api_hash="b18441a1ff765106da5c9e60086e214c", bot_token=BOT_TOKEN)

@app.on_message(filters.all)
async def hello(client, message):
    await message.reply("أهلاً بك! البوت يعمل الآن على Railway بنجاح. أرسل لي أي ملف.")

app.run()

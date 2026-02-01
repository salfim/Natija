import os
from pyrogram import Client, filters

# جلب البيانات من إعدادات Railway لاحقاً
API_ID = os.environ.get("API_ID")
API_HASH = os.environ.get("API_HASH")
BOT_TOKEN = os.environ.get("BOT_TOKEN")

app = Client("link_bot", api_id=API_ID, api_hash=API_HASH, bot_token=BOT_TOKEN)

@app.on_message(filters.document | filters.video | filters.audio)
async def generate_link(client, message):
    # ملاحظة: هذا البوت سيقوم بالرد بـ ID الملف كبداية للتأكد من العمل
    await message.reply(f"تم استلام الملف بنجاح!\nمعرف الملف (File ID): \n`{message.document.file_id}`")

print("البوت يعمل الآن...")
app.run()

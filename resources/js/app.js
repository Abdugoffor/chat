import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
Echo.channel('message')
  .listen('MessageSent', (e) => {
    // console.log(e.message);
    let messageList = document.getElementById('message-list');
    messageList.innerHTML = '';
    
    for (let index = 0; index < e.message.length; index++) {
      const message = e.message[index];

      // Foydalanuvchi o'ziga kelgan xabarlarini va o'zining yozgan xabarlarini ko'rish uchun tekshirish
      if (message.from_id == userId || message.to_id == userId) {
        messageList.innerHTML += '<p><b><i>' + message.id + '. ' + message.from + ' dan : ' + message.to + ' ga </i></b>' + message.body + '</p>';
      }
    }
  });

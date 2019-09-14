let socket = new WebSocket("ws://localhost:8080");
let username = $('.js-username').val();

socket.onmessage = function(event) {
   $('#response').text('');
   let response = JSON.parse(event.data);console.log(event.data);
   $('#chat').append('<div>'+ response.date + response.username + ':' + response.message + '</div>');
};

socket.onclose = function(event) {
    if (event.wasClean) {
        alert(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
    } else {
        // например, сервер убил процесс или сеть недоступна
        // обычно в этом случае event.code 1006
        alert('[close] Соединение прервано');
    }
};

socket.onerror = function(error) {
    alert(`[error] ${error.message}`);
};
$('#send').click(function() {
    socket.send(JSON.stringify({
        'username': username,
        'message': $('#message').val()
    }));
    $('#message').val('');
});

$('#load').click(function() {
    $('#history').children().remove();
    $.ajax({
        url: "/chat/story",
    }).done(function(response) {
        response = JSON.parse(response);
        response.forEach(function(entry) {
            $('#history').append('<div>'+ 'id: ' + entry.id + 'user: ' + entry.username + 'message: ' + entry.message + 'date: ' + entry.date + '</div>');
        });
    });
});
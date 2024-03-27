<!doctype html>
<html lang="ru">
    <head>
        <!-- <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}> -->
        <link rel="stylesheet" href={{ asset("/css/style.css") }}>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <section class="container d-flex justify-content-center py-5">
            <div class="chat shadow col-lg-8">
                <div id="scroll-chat" class="d-flex px-4 scroll flex-column-reverse">

                </div>
                    <div class="mt-1 p-4 chat-form-bg">
                        <form id="chat" class="d-flex flex-column">
                            <textarea id="message" type="text" class="form-input w-100" placeholder="Введите сообщение"></textarea>
                            <!-- <datalist id="message">
                                <option value="Привет, я новый пользователь здесь. Какие интересные темы обсуждаются в этом чате?">
                                <option value="Привет! Я только что присоединился к этому чату. Что мне нужно знать?">
                                <option value="Приветствую всех! Я новенький здесь. Какие интересные события происходят в этом чате?">
                            </datalist> -->
                            <div class="d-flex justify-content-end mt-4">
                                <button id="submit" class="form-button ms-4">Отправить</button>
                            </div>
                        </form>
                        <div class="ready-message">
                            <button id="first-message" class="my-1 first-btn">Привет, я новый пользователь здесь. Какие интересные темы обсуждаются в этом чате?</button>
                            <button id="first-message" class="my-1 first-btn">Привет! Я только что присоединился к этому чату. Что мне нужно знать?</button>
                            <button id="first-message" class="my-1 first-btn">Приветствую всех! Я новенький здесь. Какие интересные события происходят в этом чате?</button>
                        </div>
                    </div>
                </div>
                
            </div>

        </section>

        <script type="module">
            let dataStart = {!! json_encode($dataMessages) !!};

            $.each(dataStart, function(index, val) {
                if("{!! $nameUser !!}" == val['user'])
                {
                    $("#scroll-chat").prepend('<div id="delete-div" class="message my-4 d-flex justify-content-end flex-column align-items-end"><div class="px-2 message">' + val['user'] + '</div> <div style="background: #32CD32; border-radius: 8px;" class="p-3"><div class="ft-message text-end">' + val['message'] + '</div><div class="ft-date">' + String(new Date(val['created_at'])).slice(0, -38) + '</div></div> </div>')
                }
                else{
                    $("#scroll-chat").prepend('<div id="delete-div" class="message my-4 d-flex justify-content-end flex-column align-items-start"><div class="px-2 message">' + val['user'] + '</div> <div style="background: #9CE7ED; border-radius: 8px;" class="p-3"><div class="ft-message">' + val['message'] + '</div><div class="ft-date">' + String(new Date(val['created_at'])).slice(0, -38) + '</div></div> </div>')
                }

            })


            let chat = document.getElementById("scroll-chat");

            window.setInterval(() => {
                $.ajax({
                    url: "/get-data",
                    dataType: 'json',
                    success: function(res){
                        if(JSON.stringify(dataStart) != JSON.stringify(res)){
                            dataStart = res;

                            document.querySelector('#scroll-chat').innerHTML = '';

                            $.each(res, function(index, val) {
                                if("{!! $nameUser !!}" == val['user'])
                                {
                                    $("#scroll-chat").prepend('<div id="delete-div" class="message my-4 d-flex justify-content-end flex-column align-items-end"><div class="px-2 message">' + val['user'] + '</div> <div style="background: #32CD32; border-radius: 8px;" class="p-3"><div class="ft-message text-end">' + val['message'] + '</div><div class="ft-date">' + String(new Date(val['created_at'])).slice(0, -38) + '</div></div> </div>')
                                }
                                else{
                                    $("#scroll-chat").prepend('<div id="delete-div" class="message my-4 d-flex justify-content-end flex-column align-items-start"><div class="px-2 message">' + val['user'] + '</div> <div style="background: #9CE7ED; border-radius: 8px;" class="p-3"><div class="ft-message">' + val['message'] + '</div><div class="ft-date">' + String(new Date(val['created_at'])).slice(0, -38) + '</div></div> </div>')
                                }
                            })
                        }
                    }
                });
            }, 250);

            const readyMessage = document.querySelectorAll("#first-message");
            
            if({!! $countNote !!} == 0){


                $(readyMessage).on("click", function(event){
                    event.preventDefault();

                    $('#message').val($(this).html());
                });
            }
            else{
                $.each(readyMessage, function(index, val){
                    $(this).addClass('d-none');
                })
            }

            $('#chat').on('submit',function(event){
                event.preventDefault();

                let message = $('#message').val();

                if(message == ""){
                    console.log("");
                }
                else{
                    $.ajax({
                        url: "/send-message",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            message:message,
                            name: "{{ $nameUser }}",
                        },
                        success:function(response){
                            console.log(response);
                            $('#message').val('');
                        },    
                    });
                }

                if({!! $countNote !!} == 0){
                    $.each(readyMessage, function(index, val){
                        $(this).addClass('d-none');
                    })
                }
            });
        </script>

    </body>
</html>
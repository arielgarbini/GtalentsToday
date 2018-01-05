<html>
    <head></head>
    <body>
    <script>
        @if($dataFinal['error'] == true)
            @if(isset($dataFinal['url']))
                window.opener.successError({'message': "{{$dataFinal['message']}}", 'url': "{{$dataFinal['url']}}"});
            @else
                window.opener.successError({'message': "{{$dataFinal['message']}}"});
            @endif
        @else
            @if($dataFinal['register'] == true)
                window.opener.successConfirm({'register': "{{$dataFinal['register']}}", 'message': "{{$dataFinal['message']}}", 'url': "{{$dataFinal['url']}}"});
            @else
                window.opener.successConfirm({'message': "{{$dataFinal['message']}}", 'url': "{{$dataFinal['url']}}"});
            @endif
        @endif
        window.close();
    </script>
    </body>
</html>

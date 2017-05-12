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
                window.opener.successConfirm({'url': "{{$dataFinal['url']}}", 'message': "{{$dataFinal['message']}}"});
        @endif
        window.close();
    </script>
    </body>
</html>

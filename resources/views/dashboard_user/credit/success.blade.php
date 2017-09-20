<html>
    <head></head>
    <body>
    <script>
        window.opener.successConfirm({'created_at': "{{$balance->created_at->format('d/m/Y')}}", "amount": "{{$balance->credit}}"});
        window.close();
    </script>
    </body>
</html>

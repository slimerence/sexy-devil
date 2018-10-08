<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>


<h1>Hello, world!</h1>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //使用ajax方法调用跨域脚本；
        $.ajax({
            type:"GET",
            async: true,
            url:"https://forms.na2.netsuite.com/app/site/hosting/scriptlet.nl?script=818&deploy=1&compid=1299661&h=cae1cafe5a37556f79f9&customerpassword=IEACM02043250918",
            dataType: 'jsonp',
            success: function(data){
                console.log(data);
            },
            error: function(data){
                alert('failed');
            }
        });

    });
</script>

</body>
</html>
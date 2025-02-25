<html>
<head>
    <title>{{ config('app.name') }} | Frontend API's Swagger</title>
    <link href="{{asset('swagger/style.css')}}" rel="stylesheet">
</head>
<body>
    <a href="{{ route('admins.docs') }}" style="font-size: larger">admins docs</a>

<div id="swagger-ui-users"></div>

<script src="{{asset('swagger/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('swagger/swagger-bundle.js')}}"></script>
<script type="application/javascript">

    const ui_users = SwaggerUIBundle({
        url: "{{ asset('swagger/users/users.yaml') }}",
        dom_id: '#swagger-ui-users',
    });

</script>

</body>
</html>
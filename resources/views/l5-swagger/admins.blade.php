<html>
<head>
    <title>{{ config('app.name') }} | Frontend API's Swagger</title>
    <link href="{{asset('swagger/style.css')}}" rel="stylesheet">
</head>
<body>

<a href="{{ route('users.docs') }}" style="font-size: larger">users docs</a>

<div id="swagger-ui"></div>
<div id="swagger-ui-admins"></div>
<div id="swagger-ui-items"></div>
<div id="swagger-ui-users"></div>

<script src="{{asset('swagger/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('swagger/swagger-bundle.js')}}"></script>
<script type="application/javascript">
    const ui = SwaggerUIBundle({
        url: "{{ asset('swagger/admins/category.yaml') }}",
        dom_id: '#swagger-ui',
    });

    const ui_admins = SwaggerUIBundle({
        url: "{{ asset('swagger/admins/admins.yaml') }}",
        dom_id: '#swagger-ui-admins',
    });

    const ui_items = SwaggerUIBundle({
        url: "{{ asset('swagger/admins/items.yaml') }}",
        dom_id: '#swagger-ui-items',
    });

    const ui_users = SwaggerUIBundle({
        url: "{{ asset('swagger/admins/users.yaml') }}",
        dom_id: '#swagger-ui-users',
    });

</script>

</body>
</html>
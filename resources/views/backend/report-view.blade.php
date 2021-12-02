<style>
    body {
        margin:0;
        padding:0;
    }
</style>
<head>
    <title>{{$data->report_file}}</title>
</head>
<body>
    <iframe src="/uploads/{{$data->report_file}}" frameborder="0" height="617" width="1366" ></iframe>
</body>
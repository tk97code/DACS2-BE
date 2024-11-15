<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    <form action={{ route('dashboard.upload-file.handle') }} method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file-upload" id="file-upload">
        <button type="submit">submit</button>
    </form>

    @isset($questions)
    <h3>Uploaded Questions</h3>
    <ul>
        @foreach($questions as $question)
        <li>
            <strong>Level:</strong> {{ $question['level'] }}<br>
            <strong>Question:</strong> {{ $question['question'] }}<br>
            <strong>Answer:</strong> {{ $question['answer'] }}<br>
            <strong>Options:</strong>
            <ul>
                @foreach($question['option'] as $option)
                <li>{{ $option }}</li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>

    @endisset

    <script src={{asset("vendor/jquery/jquery.min.js")}}></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#file-upload').change((e) => {
            e.preventDefault();

            var file = $("#file-upload")[0].files[0];
            var formData = new FormData();
            formData.append('file-upload', file);
            console.log(formData);
            $.ajax({
                type: "post",
                url: "{{route('dashboard.upload-file.handle')}}",
                data: formData,
                contentType: false,
                processData: false,
                // dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    console.log(JSON.parse(response));
                    loadQuestionElement(JSON.parse(response));
                },
            });
        });


        function loadQuestionElement(quesions) {
            quesions.forEach(element => {
                console.log(element.question);
            });
        }

    </script>

</body>

</html>
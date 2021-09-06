<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <input type="file" name="file" id="archivo">
    <button id="enviar">
        Enviar archivo
    </button>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        $("#enviar").on('click', function() {
            let fd = new FormData();
            fd.append('archivo', document.querySelector("#archivo").files[0])
            console.log(document.querySelector("#archivo").files[0])
            fd.append('_token', "{{ csrf_token() }}")
            $.ajax({
                url: "{{ route('subir.archivo') }}",
                method: 'POST',
                processData: false,
                contentType: false,
                data: fd,
                success: function(resp) {
                    console.log(resp)
                }
            })
        })
    </script>
</body>

</html>

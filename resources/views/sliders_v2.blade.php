<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button id="btn_add">
        Agregar
    </button>

    
    @foreach ($items as $item)
        <div class="slider" data-id="{{$loop->index + 1}}">
            item - {{$loop->index + 1}}
        </div>
    @endforeach


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        $(document).on('click', '#btn_add', function(e){

            //cuenta los items con clase slider
            const lastId = $("body .slider").length

            //agrega un nuevo item con id igual a la cantidad de sliders + 1
            $(document.body).append(`
                <div class="slider" data-id="${lastId + 1}">
                    item - ${lastId + 1}
                </div>
            `)

        })
    </script>
</body>
</html>
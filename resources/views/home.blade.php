<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .slider-img {
            width: 100%
        }

    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <div class="form-row">
                <div class="col">
                    <input type="text" id="title" class="form-control" placeholder="Titulo de leccion">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder="Cantidad" id="cantidad">
                </div>
                <div class="col">
                    <button class="btn btn-primary" id="agregar-sliders">
                        agregar sliders
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="sliders-container"></div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="agregar-detalle">
                Agregar
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="lecciones">
            @foreach ($lecciones as $leccion)
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            {{$leccion->title}}
                        </h3>
                    </div>
                    <div class="col-sm-12">
                        <div class="row detalles-leccion" data-id="{{$leccion->id}}">
                            @foreach ($leccion->detalles_lecciones as $detalle)
                                <div class="card col-sm-3">
                                    <img src="{{asset('img/'.$detalle->img)}}" alt="" class="card-img-top h-100">
                                    <div class="card-footer" style="text-align: {{$detalle->posicion}}">
                                        <h5>
                                            {{$detalle->titulo}}
                                        </h5>
                                        <h6>
                                            {{$detalle->descripcion}}
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#agregar-sliders', function() {
                console.log($("#cantidad").val())
                $.ajax({
                    url: '/get-sliders',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cantidad: $("#cantidad").val()
                    },
                    success: function(sliders) {
                        $("#sliders-container").html(sliders)
                    }
                })
            })
        })

        $(document).on('change', '.detalles-slider-wrapper input[name=file]', function(e) {
            const id = $(this).data('id')
            let file = document.querySelector('.detalles-slider-wrapper[data-id="' + id + '"] input[name=file]')
                .files[0]

            readFile(file, $('#img-slider-' + id))
        })

        $(document).on('input', '.detalles-slider-wrapper select[name=posicion]', function() {
            console.log($(this).val())
            $(".detalles-slider-wrapper[data-id=" + $(this).data('id') + "] .title-description-wrapper").css(
                'text-align', $(this).val())
        })

        $(document).on('input', '.detalles-slider-wrapper input', function(e) {
            let target = $(this).data('target')
            let id = $(this).data("id")
            let value = $(this).val()

            $(`p.${target}[data-id=${id}]`).html(value)
        })

        $(document).on('click', '#agregar-detalle', function() {
            $.ajax({
                url: '/add-leccion',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: $("#title").val()
                },
                success: function(leccion) {

                    $("#lecciones").append(`
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>
                                ${leccion.title}
                            </h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="row detalles-leccion" data-id="${leccion.id}">
                            </div>
                        </div>
                    </div>
                    `)


                    $(".detalles-slider-wrapper").each(function(index, element) {
                        let inputFile = document.querySelector(
                            `input[name="file"][data-id="${index + 1}"]`)

                        let formData = new FormData()
                        formData.append('_token', '{{ csrf_token() }}')
                        formData.append('leccion_id', leccion.id)
                        formData.append('slider_data', JSON.stringify({
                            title: $(
                                `.detalles-slider-wrapper[data-id=${(index + 1)}] input[name=title]`
                            ).val(),
                            desc: $(
                                    `.detalles-slider-wrapper[data-id=${(index + 1)}] input[name=desc]`
                                )
                                .val(),
                            posicion: $(
                                    `.detalles-slider-wrapper[data-id=${(index + 1)}] select[name=posicion]`
                                )
                                .val(),
                        }))

                        formData.append('img', inputFile.files[0])

                        $.ajax({
                            url: '/add-leccion-detalles',
                            method: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            success: function(detalle) {
                                $(".detalles-leccion[data-id="+leccion.id+"]").append(`
                                    <div class="card col-sm-3">
                                        <img src="/img/${detalle.img}" alt="" class="card-img-top h-100">
                                        <div class="card-footer" style="text-align: ${detalle.posicion}">
                                            <h5>
                                                ${detalle.titulo}
                                            </h5>
                                            <h6>
                                                ${detalle.descripcion}
                                            </h6>
                                        </div>
                                    </div>
                                `)
                            }
                        })
                    });
                }
            })
        })

        function readFile(file, target) {
            let reader = new FileReader()

            reader.onload = function(event) {
                $(target).attr('src', event.target.result)
            }

            reader.readAsDataURL(file)
        }
    </script>
</body>

</html>

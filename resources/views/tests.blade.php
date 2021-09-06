@php
$items = [1, 2, 3, 4, 5, 6];
@endphp
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
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(54, 54, 54);
            min-height: 100vh;
            flex-direction: column;
        }

        .canvas {
            width: 500px;
            height: 300px;
            border: 1px solid black;
        }
        .block{
            width: 200px;
            height: 200px;
            background-color: rgb(158, 158, 158);
            position: relative;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .absolute-block{
            position: absolute;
            top: 0;
            left: 0;
            width: 50px;
            height: 50px;
            background-color: red;
        }
        .block .absolute-block{
            position: relative;
        }


    </style>
</head>

<body>
    <div class="block" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    @foreach ($items as $item)
        <div class="block absolute-block" draggable="true" data-id="block-{{$item}}" ondragstart="dragStart(event)"></div>
    @endforeach

    <script>
        let block = document.querySelector('.absolute-block')

        function allowDrop(ev){
            ev.preventDefault()
        }
        function dragStart(ev){
            ev.dataTransfer.setData("block", ev.target.dataset.id)
        }
        function drop(ev){
            ev.preventDefault();
            let data = ev.dataTransfer.getData("block")
            let block = document.querySelector('.block[data-id="'+data+'"]')
            console.log(block)
            ev.target.appendChild(block)
        }
        // document.addEventListener('mousemove', function(e){
        //     block.style.top = e.clientY + "px"
        //     block.style.left = e.clientX + "px"
        // })
    </script>
    {{-- <ul id="items">
        @foreach ($items as $item)
            <li class="item" data-id="{{ $item }}">item nro: {{ $item }}.</li>
        @endforeach
    </ul>
    <script>
        let data = [100,50,45,30,84,31,20,15,9]
        let base = 100
        let canvas = document.createElement('canvas')
        canvas.setAttribute('id', 'canvas')
        canvas.classList.add('canvas')
        document.body.appendChild(canvas)
        // document.addEventListener("mousemove", function(e) {
        //     console.log(e.pageY - canvas.offsetTop)
        // }, false);
        let ctx = canvas.getContext('2d')
        ctx.fillStyle = "blue"
        buildChart()
        function buildChart(){
            let barWidth = 20
            for (let index = 0; index < data.length; index++) {
                drawBar(index * (barWidth + 5), base, barWidth, data[index] - base)
            }
        }
        function drawBar(x, y, w, h){
            ctx.fillRect(x, y, w, h)
        }

        function drawLine() {
            ctx.lineTo(currX, currY);
            ctx.strokeStyle = x;
            ctx.lineWidth = y;
            ctx.stroke();
            ctx.closePath();
        }

        function drawArrow(fromx, fromy, tox, toy) {
            var headlen = 10; // length of head in pixels
            var dx = tox - fromx;
            var dy = toy - fromy;
            var angle = Math.atan2(dy, dx);
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 6), toy - headlen * Math.sin(angle - Math.PI / 6));
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 6), toy - headlen * Math.sin(angle + Math.PI / 6));
            ctx.stroke();
            ctx.closePath();
        }
    </script> --}}
</body>

</html>

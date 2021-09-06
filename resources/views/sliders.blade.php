@for ($i = 1; $i <= $cantidad; $i++)
    <div class="col-sm-6 col-md-4 card detalles-slider-wrapper" data-id="{{ $i }}">
        <div class="card-body">
            <div class="row">
                <div class="col-12" style="position: relative">
                    <img src="" class="slider-img" id="img-slider-{{ $i }}" alt="">
                    <div class="title-description-wrapper">
                        <p class="title" data-id="{{ $i }}"></p>
                        <p class="desc" data-id="{{ $i }}"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="title[]" data-target="title"
                                data-id="{{ $i }}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="desc[]" data-target="desc"
                                data-id="{{ $i }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <select name="posicion" id="posicion_{{ $i }}" data-id="{{ $i }}">
                                <option value="left">Izquierda</option>
                                <option value="center">Centrado</option>
                                <option value="right">Derecha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-row">
                        <div class="col">
                            <input type="file" name="file" data-id="{{ $i }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endfor

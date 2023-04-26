<div class="form-group">
    <label for="exampleInputEmail">{{$label}}</label>
    <input name="{{$name}}" value="{{$value}}" type="{{$type??'string'}}"
           class="form-control" id="exampleInputEmail"
           aria-describedby="emailHelp" placeholder="Введите email">
    <small id="emailHelp" class="form-text text-muted">Какой то текст(Руссифицировать)</small>
</div>

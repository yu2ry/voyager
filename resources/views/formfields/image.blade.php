@if(isset($dataTypeContent->{$row->field}))
    <img src="@if( !filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $dataTypeContent->{$row->field} ) }}@else{{ $dataTypeContent->{$row->field} }}@endif"
         id="image-edit-full" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
    @if($image = array_values(array_filter($dataType->toArray()['browse_rows'], function ($item) {
        $details = json_decode($item['details'], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $details = json_decode($item['details'], true);
            return isset($details['route_delete']);
        }
        return false;
    })))
        <script>
            function ajax() {
                let request = new XMLHttpRequest();
                let elem = document.getElementById('image_delete');
                request.open('POST', '{{ route(json_decode($image[0]['details'], true)['route_delete'], $dataTypeContent->id) }}', true);
                request.addEventListener('readystatechange', function () {
                    if ((request.readyState == 4) && (request.status == 200)) {
                        elem.remove();
                        document.getElementById('image-edit-full').remove();
                    }
                });
                request.send();
            }
        </script>
        <button onclick="ajax()" style="margin-bottom: 20px" type="button" class="btn btn-danger" id="image_delete">Удалить изображение</button>
    @endif
@endif
<input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif type="file" name="{{ $row->field }}" accept="image/*">

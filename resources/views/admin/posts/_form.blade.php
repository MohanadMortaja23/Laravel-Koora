@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="row">

   
    
    <div class="form-group col-md-6">
        <div class="form-group ">
            <label for="exampleFormControlInput1"><strong>نوع المنشور</strong></label>
            <select name="type" id="type" class="form-control" id="exampleSelect1">
            <option>اختار نوع المنشور</option>
              <option value="1">خبر</option>
              <option value="2" @selected($post->Options->count() > 0)>تصويت</option>
            </select>
          </div>
    </div>
    <div id="vote" hidden  class="form-group col-md-6 ">
        <div class="row">
            <div>
                <label for="exampleFormControlInput1"><strong>صورة الخيار الاول</strong></label>
                <input name="option1" rows="2" type="file" class="form-control" rows="3" />
            </div>
            <div>
                <label for="exampleFormControlInput1"><strong>صورة الخيار الثاني</strong></label>
                <input name="option2" rows="2" type="file" class="form-control" rows="3" />
            </div>
        </div>
    </div>

    <div id="image" hidden class="form-group col-md-6">
        <label for="exampleFormControlInput1"><strong>صورة المنشور</strong></label>
        <input name="image" rows="2" type="file" class="form-control" rows="3" />
    </div>


    <div class="form-group col-md-6">
        <label for="exampleFormControlInput1"><strong>محتوى المنشور</strong></label>
        <textarea name="details" rows="2"  class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('details' , $post->details) }}</textarea>
    </div>

    <div class="form-group col-md-6">
        <label for="exampleFormControlInput1"><strong> المصدر </strong></label>
        <input name="owner" rows="2" type="text" class="form-control" rows="3" value="{{ old('owner' , $post->owner) }}" />
    </div>
    
    <div class="form-group col-md-6">
        <label for="exampleFormControlInput1"><strong>رابط الخبر او  المصدر </strong></label>
        <input name="link" rows="2" type="text" class="form-control" rows="3" value="{{ old('link' , $post->link ) }}"  />
    </div>
   

</div>


<div class="row">
   
</div>

<hr>





<button type="submit" class="btn btn-primary">{{ $button }}</button>

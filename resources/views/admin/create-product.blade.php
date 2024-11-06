<!-- custom css file link -->
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<style>
    form
    {
        border: none;
        background: #fff;
        padding: .5rem 3rem 3rem 3rem;
        font-size: 1.3rem;
    }
    .box
    {
        padding: 0;
        width: 100%;
        position: relative;
    }
    .box label
    {
        top: 50%;
        left: 5px;
        font-size: 1.2rem;
        color: #333;
    }
    .box input
    {
        border: none;
        outline: none;
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        text-transform: none;
        padding: 0 35px 0 5px;
    }
    select
    {
        border: none;
        outline: none;
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        text-transform: none;
        background: #F7F9FA;
        border-radius: .5rem;
        width: 100%;
        height: 100%;
        padding: 10px 35px 10px 5px;
        appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.2 6.5a.5.5 0 0 1 .8 0L8 10.5l4.3-4a.5.5 0 0 1 .8.6l-4.8 4.5a.5.5 0 0 1-.7 0L2.4 7.1a.5.5 0 0 1 0-.6z"/></svg>'); /* Custom dropdown icon */
        background-repeat: no-repeat;
        background-position: right 10px center;
    }
</style>
<x-admin-layout>
    <!-- createproduct section starts -->
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">create product</h1>
    <div style="display: flex; justify-content: center; align-items: center; width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
        <form class="create-product" style="width: 600px;" action="/admin/products"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-box">
                <input name="name" type="text" id="name" placeholder=" " value="{{ old('name') }}">
                <label>Name <span style="color: red;">*</span> </label>
            </div>
            @error('name')
                <div class="error-message name" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">image <span style="color: red;">*</span> </label>
                <input name="image" type="file">                    
            </div>
            @error('image')
                <div class="error-message image" style="color: red; margin: .5rem 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <input name="slug" type="text" id="slug" placeholder=" " value="{{ old('slug') }}">
                <label>Slug <span style="color: red;">*</span> </label>
            </div>
            @error('slug')
                <div class="error-message slug" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <input id="subtext" name="subtext" type="text" id="subtext" placeholder=" " value="{{ old('subtext') }}">
                <label for="subtext">Subtext</label>
            </div>
            <div class="input-box">
                <input name="price" type="number" id="price" placeholder=" " value="{{ old('price') }}">
                <label>Price <span style="color: red;">*</span> </label>
            </div>
            @error('price')
                <div class="error-message price" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <input name="color" type="text" id="color" placeholder=" " value="{{ old('color') }}">
                <label>Color <span style="color: red;">*</span> </label>
            </div>
            @error('color')
                <div class="error-message color" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <textarea name="description" id="description" placeholder=" ">{{ old('description') }}</textarea>
                <label>Description <span style="color: red;">*</span> </label>
            </div>
            @error('description')
                <div class="error-message description" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 1</label>
                <input name="icon1" type="file">                  
            </div>
            <div class="input-box">
                <input name="icon1text" type="text" id="icon1text" placeholder=" " value="{{ old('icon1text') }}">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 2</label>
                <input name="icon2" type="file">                    
            </div>
            <div class="input-box">
                <input name="icon2text" type="text" id="icon2text" placeholder=" " value="{{ old('icon2text') }}">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 3</label>
                <input name="icon3" type="file">                  
            </div>
            <div class="input-box">
                <input name="icon3text" type="text" id="icon3text" placeholder=" " value="{{ old('icon3text') }}">
                <label>info</label>
            </div>
            <div class="input-box">
                <input name="discountpercentage" type="number" id="discountpercentage" placeholder=" " value="{{ old('discountpercentage') }}">
                <label>Discount Percentage</label>
            </div>
            
            <div class="input-box">
                <select name="category" class="category" id="category">
                    <option value="" hidden selected disabled>Select</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <label>Category <span style="color: red;">*</span></label>
            </div>
            @error('category')
                <div class="error-message category" style="color: red; margin: -30px 0 30px 5px;">
                    {{ $message }}
                </div>
            @enderror
            
            <button type="submit" class="btn1" aria-label="Create">Create</button>
        </form>
    </div>
    <!-- createproduct section starts -->
</x-admin-layout>
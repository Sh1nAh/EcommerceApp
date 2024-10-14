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
        padding: 1rem 35px 1rem 5px;
        border-radius: .5rem;
    }
    #create
    {
        margin-top: 3rem;
    }
</style>
<x-admin-layout>
    <!-- createproduct section starts -->
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">create product</h1>
    <div style="width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
        {{-- <form action="/admin/products"  method="POST" enctype="multipart/form-data">
            @csrf
            <label for="">image</label>
            <input name="image" type="file" class="box">
            @error('image')
                <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
            @enderror
            <label for="">name</label>
            <input name="name" type="text" class="box" value="{{ old('name') }}">
            @error('name')
                <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
            @enderror
            <label for="">slug</label>
            <input name="slug" type="text" class="box" value="{{ old('slug') }}">
            @error('slug')
                <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
            @enderror
            <label for="">price</label>
            <input name="price" type="number" class="box" value="{{ old('price') }}">
            @error('price')
                <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
            @enderror
            <label for="">discount percentage</label>
            <input name="discount_percentage" type="number" class="box" value="{{ old('discount_percentage') }}">
            @error('discount_percentage')
                <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
            @enderror
            <label for="">category</label>
            <select name="category_id" class="box">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button id="create" type="submit" class="btn">create</button>
        </form> --}}
        <form action="/admin/products"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-box">
                <input name="name" type="text" required>
                <label>Name</label>
                <div class="error-message name" style="color: red;">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">image</label>
                <input name="image" type="file" required>
                <div class="error-message image" style="color: red;">
                    @error('image') {{ $message }} @enderror
                </div>                    
            </div>
            <div class="input-box">
                <input name="slug" type="text" required>
                <label>Slug</label>
                <div class="error-message slug" style="color: red;">
                    @error('slug') {{ $message }} @enderror
                </div>
            </div>
            <div class="input-box">
                <input name="subtext" type="text">
                <label>Subtext</label>
            </div>
            <div class="input-box">
                <input name="price" type="number" required>
                <label>Price</label>
                <div class="error-message price" style="color: red;">
                    @error('price') {{ $message }} @enderror
                </div>
            </div>
            <div class="input-box">
                <input name="description" type="text" required>
                <label>Description</label>
                <div class="error-message description" style="color: red;">
                    @error('description') {{ $message }} @enderror
                </div>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 1</label>
                <input name="icon1" type="file">                  
            </div>
            <div class="input-box">
                <input name="icon1text" type="text">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 2</label>
                <input name="icon2" type="file">                    
            </div>
            <div class="input-box">
                <input name="icon2text" type="text">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 3</label>
                <input name="icon3" type="file">                  
            </div>
            <div class="input-box">
                <input name="icon3text" type="text">
                <label>info</label>
            </div>
            <div class="input-box">
                <input name="discount_percentage" type="number" required>
                <label>Discount Percentage</label>
            </div>
            <div class="box">
                <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="create" type="submit" class="btn1" aria-label="Create">Create</button>
        </form>
    </div>
    <!-- createproduct section starts -->
</x-admin-layout>
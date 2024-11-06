<!-- custom css file link -->
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<style>
    /* .orderlist
    {
        overflow-x: auto;
    }
    tr, th, td
    {
        padding: 1rem;
        color: #333;
        background: #fff;
    }
    td
    {
        text-transform: none;
    }
    th
    {
        text-align: left;
    }
    textarea{
        resize: none;
        margin: 0;
        height: 10rem;
        display: block;
        width: 100%;
        font-size: 1.3rem;
        color: #666;
        border: none;
        outline: none;
        font-weight: 600;
        background: #F7F9FA;
        border-radius: .5rem;
        text-transform: none;
        padding: 1.5rem 35px 1.5rem 5px;
    }
    .text-yellow
    {
        color: #FDE370; 
    } */
    /* .text-red
    { */
        /* color: #E87272; */
        /* color: #E69397;
    } */
    /* .text-green
    {
        color: #88CE74;
    }
    a,button:hover
    {
        cursor: pointer;
    }
    label
    {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }
    input, select
    {
        display: block;
        width: 100%;
        font-size: 1.3rem;
        color: #666;
        border: none;
        outline: none;
        font-weight: 600;
        background: #F7F9FA;
        border-radius: .5rem;
        text-transform: none;
        padding: 0 35px 0 5px;
        height: 50px;
    }
    .box
    {
        background: none;
        margin: 1rem 0;
        height: auto;
        padding: 0;
    } */

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
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">edit product</h1>    
    {{-- <div>
        <div class="orderlist">
            <form action="/admin/products/{{ $product->id }}/update"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <table style="width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
                <tr style="height: 5rem;">
                    <th>Id</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Image</th>
                    <td>
                        <input name="image" type="file" class="box">
                        <div style="margin-bottom: 1.5rem;">
                            <img style="width: 200px; height: 200px;" src="{{ $product->image }}" alt="">
                        </div>
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Name</th>
                    <td>
                        <input name="name" type="text" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Slug</th>
                    <td>
                        <input name="slug" type="text" value="{{ old('slug', $product->slug) }}">
                        @error('slug')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Subtext</th>
                    <td>
                        <input name="subtext" type="text" value="{{ old('subtext', $product->subtext) }}">
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Color</th>
                    <td>
                        <input name="color" type="text" value="{{ old('color', $product->color) }}">
                        @error('color')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Price</th>
                    <td>
                        <input name="price" type="number" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Description</th>
                    <td>
                        <textarea name="description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Chip</th>
                    <td>
                        <input name="icon1" type="file" class="box">
                        <div style="margin-bottom: 1.5rem;">
                            <img style="width: 200px; height: 200px;" src="{{ $product->icon1 }}" alt="">
                        </div>
                        <input name="icon1text" type="text" value="{{ old('icon1text', $product->icon1text) }}">
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Camera</th>
                    <td>
                        <input name="icon2" type="file" class="box">
                        <div style="margin-bottom: 1.5rem;">
                            <img style="width: 200px; height: 200px;" src="{{ $product->icon2 }}" alt="">
                        </div>
                        <input name="icon2text" type="text" value="{{ old('icon2text', $product->icon2text) }}">
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Battery</th>
                    <td>
                        <input name="icon3" type="file" class="box">
                        <div style="margin-bottom: 1.5rem;">
                            <img style="width: 200px; height: 200px;" src="{{ $product->icon3 }}" alt="">
                        </div>
                        <input name="icon3text" type="text" value="{{ old('icon3text', $product->icon3text) }}">
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>discount</th>
                    <td>
                        <input name="discount_percentage" type="number" value="{{ old('discount_percentage', $product->discountpercentage) }}">
                        @error('discount_percentage')
                            <p style="color: red; text-align: left; margin-left: 0.5rem;" class="error-message">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <th>Category</th>
                    <td>
                        <select name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{$category->id == $product->category_id ? 'selected' : ''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr style="height: 5rem;">
                    <td colspan="2" style="background-color: #F7F9FA; padding: 0;">
                        <button style="margin-top: 1.5rem;" id="create" type="submit" class="btn1">update</button>
                    </td>
                </tr>
            </form>
            </table>
        </div>
    </div> --}}

    <div style="display: flex; justify-content: center; align-items: center; width: 100%; border: none; padding: 1rem 3rem 3rem 3rem; background-color: #F7F9FA; font-size: 1.3rem;">
        <form style="width: 600px;" action="/admin/products/{{ $product->id }}/update"  method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-box">
                <label>Product ID : <span style="font-weight: bold;">{{ $product->id }}</span></label>
            </div>
            <div class="input-box">
                <input name="name" id="name" type="text" value="{{ old('name', $product->name) }}" placeholder=" ">
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
                <div style="margin-top: 1.5rem;">
                    <img style="width: 200px; height: 200px;" src="{{ $product->image }}" alt="">
                </div>        
            </div>
            <div class="input-box">
                <input name="slug" id="slug" type="text" value="{{ old('slug', $product->slug) }}" placeholder=" ">
                <label>Slug <span style="color: red;">*</span> </label>
            </div>
            @error('slug')
                <div class="error-message slug" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <input id="subtext" name="subtext" type="text" value="{{ old('subtext', $product->subtext) }}" placeholder=" ">
                <label for="subtext">Subtext</label>
            </div>
            <div class="input-box">
                <input name="price" id="price" type="number" value="{{ old('price', $product->price) }}" placeholder=" ">
                <label>Price <span style="color: red;">*</span> </label>
            </div>
            @error('price')
                <div class="error-message price" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box">
                <input name="color" id="color" type="text" value="{{ old('color', $product->color) }}" placeholder="">
                <label>Color <span style="color: red;">*</span> </label>
            </div>
            @error('color')
                <div class="error-message color" style="color: red; margin: -30px 0 30px 5px;">
                {{ $message }}
                </div>
            @enderror
            <div class="input-box"> 
                <textarea name="description" id="description" placeholder=" ">{{ old('description', $product->description) }}</textarea>
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
                <div style="margin-top: 1.5rem;">
                    <img style="width: 100px; height: 100px;" src="{{ $product->icon1 }}" alt="">
                </div>             
            </div>
            <div class="input-box">
                <input name="icon1text" id="icon1text" type="text" value="{{ old('icon1text', $product->icon1text) }}" placeholder=" ">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 2</label>
                <input name="icon2" type="file">
                <div style="margin-top: 1.5rem;">
                    <img style="width: 100px; height: 100px;" src="{{ $product->icon2 }}" alt="">
                </div>                 
            </div>
            <div class="input-box">
                <input name="icon2text" id="icon2text" type="text" value="{{ old('icon2text', $product->icon2text) }}" placeholder=" ">
                <label>info</label>
            </div>
            <div class="box">
                <label style="display: block; margin-bottom: .5rem; padding-left: 5px;">icon 3</label>
                <input name="icon3" type="file">
                <div style="margin-top: 1.5rem;">
                    <img style="width: auto; height: 70px;" src="{{ $product->icon3 }}" alt="">
                </div>                 
            </div>
            <div class="input-box">
                <input name="icon3text" id="icon3text" type="text" value="{{ old('icon3text', $product->icon3text) }}" placeholder=" ">
                <label>info</label>
            </div>
            <div class="input-box">
                <input name="discount_percentage" id="discount_percentage" type="number" value="{{ old('discount_percentage', $product->discountpercentage) }}" placeholder=" ">
                <label>Discount Percentage</label>
            </div>
            <div class="input-box">
                <select name="category" class="category" id="category">
                    <option value="" hidden selected disabled>Select</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id == $product->category_id ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <label>Category <span style="color: red;">*</span></label>
            </div>
            <button id="create" type="submit" class="btn1" aria-label="Create">update</button>
        </form>
    </div>
    </section>
</x-admin-layout>
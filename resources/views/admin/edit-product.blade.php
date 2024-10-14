<!-- custom css file link -->
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<style>
    .orderlist
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
        padding: 0 35px 0 5px;
    }
    .text-yellow
    {
        color: #FDE370; 
    }
    .text-red
    {
        /* color: #E87272; */
        color: #E69397;
    }
    .text-green
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
    }
</style>
<x-admin-layout>
    <section style="margin-top: 6rem;">
    <h1 class="heading" style="padding-top: 2rem; margin-bottom: 0; font-size: 2rem;">edit product</h1>    
    <div>
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
    </div>
    </section>
</x-admin-layout>
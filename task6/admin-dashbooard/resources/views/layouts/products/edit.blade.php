@extends('layouts.parent')


@section('title' ,'Edit Product')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">


                <form   action ="{{route('dashboard.products.update',$products->id)}}" method="post" class="mt-5 " enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_en">Product Name (En)</label>
                                <input id="name_en" name="name_en" type="text" class="form-control" value ="{{$products->name_en}}">
                            </div>
                            @error('name_en')
                            <div class="alert alert-white text-danger">{{ $message }}</div>
                        @enderror

                            <div class="form-group">
                                <label for="name_ar">Product Name (Ar)</label>
                                <input id="name_ar" name="name_ar" type="text" class="form-control" value ="{{$products->name_ar}}">
                            </div>

                            @error('name_ar')
                            <div class="alert alert-white text-danger">{{ $message }}</div>
                        @enderror



                        </div>


                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="code">code</label>
                                <input id="code" name="code" type="text" class="form-control" value ="{{$products->code}}">
                            </div>
                            @error('code')
                            <div class="alert alert-white text-danger">{{ $message }}</div>
                        @enderror


                               <div class="form-group">
                                <label for="price">Price</label>
                                <input id="price" name="price" type="text" class="form-control" value ="{{$products->price}}">
                            </div>
                            @error('price')
                            <div class="alert alert-white text-danger">{{ $message }}</div>
                        @enderror
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" name="quantity" type="number" class="form-control" value ="{{$products->quantity}}">
                            </div>
                            @error('quantity')
                            <div class="alertalert-white text-danger">{{ $message }}</div>
                        @enderror
                            <div class="form-group">
                                <label for ="status" class="control-label">status</label>
                                <select class="form-control select2 select2-hidden-accessible" name="status" id="status" >
                                   <option></option>
                                    <option @selected($products->status == 1) value="1">Available</option>
                                    <option @selected($products->status == 0) value="0">Not available</option>
                                </select>

                                @error('status')
                                <div class="alert alert-white text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="brand_id">Brand</label>
                                <select class="form-control select2 select2-hidden-accessible" name="brand_id" id="brand_id" >
                                    <option value =""></option>
                                    @foreach ( $brands as $brand)
                                   <option @selected($products->brand_id == $brand->id) value="{{$brand->id}}">{{$brand->name_en}} </option>
                                   @endforeach

                                </select>
                                @error('brand_id')
                                <div class="alert alert-white text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="subcategory_id">Subcategory</label>
                                <select class="form-control select2 select2-hidden-accessible" name="subcategory_id" id="subcategory_id">
                                   <option></option>
                                    @foreach ( $subcategories as $subcategory)
                                    <option @selected($products->subcategory_id == $subcategory->id) value="{{$subcategory->id}}">{{$subcategory->name_en}} </option>
                                    @endforeach

                                </select>

                                @error('subcategory_id')
                                <div class="alert alert-white text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>


                    </div>


                    <div class="col-12">
                        <div class="form-group">
                            <label for="details_en">Details (EN)</label>
                            <textarea class="form-control" name= "details_en" id="details_en" rows="5">{{$products->details_en}}</textarea>
                        </div>
                        @error('details-en')
                        <div class="alert alert-white text-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="details_ar">Details (Ar)</label>
                            <textarea class="form-control" name="details_ar" id="details_ar" rows="5">{{$products->details_ar}}</textarea>
                        </div>

                        @error('details_ar')
                        <div class="alert alert-white text-danger">{{ $message }}</div>
                    @enderror
                    </div>


                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <img src="{{asset ('images/product/'.$products->image)}}" alt="" class="w-100 ">
                            <input type="file" name="image" class="form-control" id="image">
                            <button type="button" class="btn btn-info mt-2 waves-effect waves-light">Change Image</button>
                        </div>

                        @error('image')
                        <div class="alert alert-white text-danger">{{ $message }}</div>
                    @enderror

                    </div>



                    <button type="submit"  class="btn btn-success mr-1 waves-effect waves-light">Update</button>

                </form>

            </div>
        </div>


    </div>

@endsection

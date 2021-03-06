@extends('layout.admin.index')
@section('extra_css')
   <!-- the script in this page wont work with pjax so i hava to reload it  -->
   @if (env('APP_AJAX'))
      <script type="text/javascript">
          $(document).on('pjax:complete', function() {
              pjax.reload();
          })
      </script>
   @endif
{{--   <link rel="stylesheet" href="{{ asset('admin-assets/css/w3.css') }}">--}}
@endsection
@section('content')
    <a class="btn btn-danger" href="{{ route('product.index') }}"><i class="fa fa-arrow-left"></i> Quay lại</a>
    <div class="hr dotted"></div>
    <div id="user-profile-1" class="user-profile row">
         <div class="col-xs-12 col-sm-3 center">
            @if (count($product->ImageUrls) > 0)
               <div class="clearfix w3-display-container">
                  @foreach($product->ImageUrls as $key => $photo)
                     <a href="{{$photo}}" target="_blank">
                        <img class="img-responsive mySlides" src="{{ $photo }}"
                             alt="{{ $photo }}" style="width:100%; height: 400px">
                     </a>
                  @endforeach
                  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
               </div>
               @else
               <div class="clearfix">
                  <h2 class="text-danger bolder">WITHOUT PHOTO</h2>
               </div>
            @endif

           {{-- <div class="clearfix">
               <div class="grid2">
                  <span class="bigger-175 blue">25</span>
                  <br>
                  Followers
               </div>

               <div class="grid2">
                  <span class="bigger-175 blue">12</span>
                  <br>
                  Following
               </div>
            </div>--}}
            @can('product-edit')
               <div class="hr hr16 dotted"></div>
               <div class="profile-contact-links align-left ">
                  <a href="{{route('product.edit',$product->Id)}}" class="btn btn-link">
                     <i class="ace-icon fa fa-plus-circle bigger-120 warning"></i>
                     Edit product
                  </a>
               </div>

               <div class="space-2"></div>
               <div class="profile-contact-links align-left ">
                  <a href="{{ route('attribute.edit',$product->Id) }}" class="btn btn-link">
                     <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                     Edit Attributes
                  </a>
               </div>
            @endcan
         </div>

         <div class="col-xs-12 col-sm-9">
            <div class="profile-user-info profile-user-info-striped">
               <div class="profile-info-row">
                  <div class="profile-info-name">Tên sản phẩm</div>
                  <div class="profile-info-value">
                     <span class="editable editable-click" id="username">{{ $product->Name }}</span>
                  </div>
               </div>

                <div class="profile-info-row">
                    <div class="profile-info-name">Mã sản phẩm</div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username">{{ $product->ProductCode }}</span>
                    </div>
                </div>
                {{--
                <div class="profile-info-row">
                    <div class="profile-info-name">Tên chi nhánh</div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username">{{ $product->BranchName }}</span>
                    </div>
                </div>
                --}}

                <div class="profile-info-row">
                    <div class="profile-info-name">Nhóm hàng</div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username">{{ $product->GroupName }}</span>
                    </div>
                </div>
                {{--
               <div class="profile-info-row">
                  <div class="profile-info-name"> SKU</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="country">{{ $product->ProductCode }}</span>
                  </div>
               </div>
               --}}

               <div class="profile-info-row">
                  <div class="profile-info-name"> Giá nhập</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="age">
                         @if(isRead(env('VIEW_UNIT_PRICE_CODE')))
                             {{ $product->UnitPrice }}
                         @else
                             *************
                         @endif

                     </span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name">Giá bán</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="age">{{ $product->Price }}</span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name">Giảm giá</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="age">{{ $product->Discount }}%</span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name">Số lượng</div>
                  <div class="profile-info-value">
                     <span class="editable editable-click" id="about">
                         {{ $product->InStock }}
                     </span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name">Đơn vị tính</div>
                  <div class="profile-info-value">
                     <span class="editable editable-click" id="about">
                        {{ $product->Unit }}
                     </span>
                  </div>
               </div>
               <div class="profile-info-row">
                  <div class="profile-info-name">Chuyên Mục</div>
                  <div class="profile-info-value">
                   <span class="editable editable-click" id="description">
                       <span class='label label-default'>
                           {{($product->IsNew==true)?"Sản phẩm mới":""}}
                           {{($product->IsNew==true&&$product->IsFeature==true)?",":""}}
                           {{($product->IsFeature==true)?"Sản phẩm nổi bật":""}}
                       </span>
                   </span>
                  </div>
              </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Mô tả nhập hàng</div>
                    <div class="profile-info-value">
                     <span class="editable editable-click" id="s_NoteImport">
                         <span class='label label-default'>{{ $product->s_NoteImport }}</span>
                     </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Mô tả đặt hàng</div>
                    <div class="profile-info-value">
                     <span class="editable editable-click" id="s_NoteOrder">
                         <span class='label label-default'>{{ $product->s_NoteOrder }}</span>
                     </span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Mô tả</div>
                    <div class="profile-info-value">
                     <span class="editable editable-click" id="description">
                         <span class='label label-default'>{{ $product->Description }}</span>
                     </span>
                    </div>
                </div>
{{--
               <div class="profile-info-row">
                  <div class="profile-info-name">Tags</div>
                  <div class="profile-info-value">
                     <span class="editable editable-click" id="about">
                        @foreach($product->tags as $tag)
                           <span class='label label-info'>{{ $tag->tag_name }}</span>
                        @endforeach
                     </span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name">Attributes</div>
                  <div class="profile-info-value">
                     <span class="editable editable-click" id="about">
                        @forelse($product->attributes as $attribute)
                           <b>{{ $attribute->attr_name }}:</b>
                           @foreach($attribute->attributeValues as $value)
                              <span class='label label-default'>{{ $value->value }}</span>
                           @endforeach
                        @empty
                           <b>NO ATTRIBUTES</b>
                        @endforelse
                     </span>
                  </div>
               </div>

               <div class="profile-info-row">
                  <div class="profile-info-name"> Created Date</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="signup">{{ $product->created_at }}</span>
                  </div>
               </div>
               <div class="profile-info-row">
                  <div class="profile-info-name"> Updated Date</div>

                  <div class="profile-info-value">
                     <span class="editable editable-click" id="signup">{{ $product->updated_at }}</span>
                  </div>
               </div>
               --}}
            </div>
            {{--
            <h2>Comments</h2>
            <h6>red color not approved yet </h6>
            <div class="col-sm-6">
               @forelse($comments as $comment)
                  <div class="well well-lg"
                       style="background-color: {{ $comment->approved == 1 ? '#79ffb2': '#ffaf93'}}">
                     <h4 class="">
                        @if($comment->commenter_id =! null)
                           <span class="tag blue"><b>{{ $comment->guest_name }}</b></span>
                           <small><a href="mailTo:{{ $comment->guest_email }}">{{ $comment->guest_email }}</a></small>
                        @else
                           {{ $comment->commenter() }}
                        @endif
                     </h4>
                     {{$comment->comment}}
                  </div>
               @empty
                  no comments yet
               @endforelse
               $comments->links()
            </div>
            --}}
      </div>
   </div>
    <hr/>
   <ul class="nav nav-tabs">
       <li class="@if($type == 'in-stock') active @endif">
           <a  href="{{ route("product.show", $product->Id) }}">Danh sách tồn kho</a>
       </li>
       {{--
       <li class="@if($type == 'order') active @endif"><a href="{{ route("products.history", ['id' => $product->Id, 'type' => 'order']) }}">Lịch sử đặt hàng</a>
       </li>
       <li class="@if($type == 'import') active @endif"><a href="{{ route("products.history", ['id' => $product->Id, 'type' => 'import']) }}">Lịch sử nhập hàng của nhà cung cấp</a>
       </li>
       --}}
   </ul>
   <br/>
   <div class="row">
       <div class="col-sm-12 col-lg-12 col-xs-12">
           <table id="simple-table" class="table table-bordered table-hover table-responsive">
               <thead>
               <tr>
                   <th>#</th>
                   @if($type == 'in-stock')
                       <th>Tên kho</th>
                       <th class="center">Tồn</th>
{{--                       <th>Qty Purchase Order</th>--}}
                   @else
                       <th>Số hóa đơn</th>
                       <th class="center">Ngày hóa đơn</th>
                       <th>Tổng tiền</th>
                       <th>Nhân viên</th>
                       <th>Số lượng</th>
                       <th>Đơn vị tính</th>
                       <th>Discount</th>
                       <th>Exchange</th>
                   @endif
               </tr>
               </thead>
               <tbody id="table_body" class="table_data">
               @if($type == 'in-stock')
                   @include('admin.products.stocks._data')
               @else
                @include('admin.products.history._data')
               @endif
               </tbody>
           </table>
       </div>
       <div class="col-sm-12 text-center">
           @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
               {{ $data->appends(request()->except('page'))->links() }}
           @endif
       </div>
   </div>
@endsection
@section('extra_js')
   <!-- FOR IMAGE SLIDER -->
   <script type="text/javascript">
       var slideIndex = 1;
       showDivs(slideIndex);

       function plusDivs(n) {
           showDivs(slideIndex += n);
       }

       function showDivs(n) {
           var i;
           var x = document.getElementsByClassName("mySlides");
           if (n > x.length) {
               slideIndex = 1
           }
           if (n < 1) {
               slideIndex = x.length
           }
           for (i = 0; i < x.length; i++) {
               x[i].style.display = "none";
           }
           x[slideIndex - 1].style.display = "block";
       }
   </script>
@stop

@php 
$route = Route::currentRouteName()
@endphp
<div class="br-logo"><a href=""><span>[</span>Pointsoft <i>plus</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
      
      <ul class="br-sideleft-menu">

        <li class="br-menu-item">
          <a href="{{ route('admin.dashboard') }}" class="br-menu-link  {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
        <!----------Customer  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Customer </span>
          </a>
          <ul class="br-menu-sub" >
            
          <li class="sub-item"><a href="#" class="sub-link ">Add Customer</a></li>

            <li class="sub-item"><a href="#" class="sub-link">Customer List</a></li>
            <li class="sub-item"><a href="#" class="sub-link">Customer Invoice</a></li>

            
          </ul>
        </li>
        <!----------Blog  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Blog </span>
          </a>
          <ul class="br-menu-sub" >
            <li class="sub-item"><a href="#" class="sub-link">Category Add</a></li>
            <li class="sub-item"><a href="#" class="sub-link">Category List</a></li>
            <li class="sub-item"><a href="#" class="sub-link ">Add Blog</a></li>
            <li class="sub-item"><a href="#" class="sub-link ">Blog List</a></li>
          </ul>
        </li>
        <!----------Address  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Address </span>
          </a>
          <ul class="br-menu-sub" >
            <li class="sub-item"><a href="#" class="sub-link">Country List</a></li>
            <li class="sub-item"><a href="#" class="sub-link">State List</a></li>
            <li class="sub-item"><a href="#" class="sub-link">City List</a></li> 
            <li class="sub-item"><a href="#" class="sub-link ">Add Address</a></li>            
          </ul>
        </li>
        <!----------Product Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/product')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Products</span>
          </a>
          <ul class="br-menu-sub" >
            
          <li class="sub-item"><a href="{{route('admin.brand.index')}}" class="sub-link {{ ($route == 'admin.brand.index' || $route == 'admin.brand.edit' || $route == 'admin.brand.update')? 'active':'' }}">Brand</a></li>

            <li class="sub-item"><a href="{{route('admin.category.index')}}" class="sub-link {{ ($route == 'admin.category.index' || $route == 'admin.category.edit' || $route == 'admin.category.update')? 'active':'' }}">Category</a></li>

            <li class="sub-item"><a href="{{route('admin.subcategory.index')}}" class="sub-link {{ ($route == 'admin.subcategory.index' || $route == 'admin.subcategory.edit' || $route == 'admin.subcategory.update')? 'active':'' }}">Sub Category</a></li>

            <li class="sub-item"><a href="{{route('admin.childcategory.index')}}" class="sub-link {{ ($route == 'admin.childcategory.index' || $route == 'admin.childcategory.edit' || $route == 'admin.childcategory.update')? 'active':'' }}">Child Category</a></li>

            <li class="sub-item"><a href="{{route('admin.products.create')}}" class="sub-link  {{ ( $route == 'admin.products.create')? 'active':'' }}">Add Product</a></li>

            <li class="sub-item"><a href="{{route('admin.shipping.index')}}" class="sub-link {{ ($route == 'admin.shipping.index' || $route == 'admin.discount.edit' || $route == 'admin.discount.update')? 'active':'' }}">Shipping Charge</a></li>

            <li class="sub-item"><a href="{{route('admin.discount.index')}}" class="sub-link {{ ($route == 'admin.discount.index' || $route == 'admin.discount.edit' || $route == 'admin.discount.update')? 'active':'' }}">Discount Product</a></li>

            <li class="sub-item"><a href="{{route('admin.products.index')}}" class="sub-link {{ ($route == 'admin.products.index' || $route == 'admin.products.edit' || $route == 'admin.products.update')? 'active':'' }}">Product Management</a></li>

            <li class="sub-item"><a href="#" class="sub-link">Product Review</a></li>
          </ul>
        </li>


        <!---------- Orders Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link ">
            <i class="menu-item-icon icon ion-ios-medkit-outline tx-24"></i>
            <span class="menu-item-label">Orders </span>
          </a>
        </li>


        <!----------Saller Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/seller')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-person-stalker tx-20"></i>
            <span class="menu-item-label">Seller </span>
          </a>
          <ul class="br-menu-sub" >
            
          <li class="sub-item"><a href="{{route('admin.seller.create')}}" class="sub-link {{ ($route == 'admin.seller.create')? 'active':'' }}">Seller Add</a></li>

            <li class="sub-item"><a href="{{route('admin.seller.index')}}" class="sub-link {{ ($route == 'admin.seller.index' || $route == 'admin.category.edit')? 'active':'' }}">Seller List</a></li>

            <li class="sub-item"><a href="{{route('admin.seller.withdraw.index')}}" class="sub-link {{ ($route == 'admin.seller.withdraw.index'||$route == 'admin.seller.withdraw.edit')? 'active':'' }}">Withdraw Request</a></li>

            <li class="sub-item"><a href="#" class="sub-link ">Withdraw Approved</a></li>

            <li class="sub-item"><a href="#" class="sub-link ">Withdraw Reject</a></li>
            
            <li class="sub-item"><a href="#" class="sub-link ">Seller Review</a></li>

            <li class="sub-item"><a href="#" class="sub-link ">Seller Invoice</a></li>

          </ul>
        </li>
        <!----------Shop Management Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub ">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Shop </span>
          </a>
          <ul class="br-menu-sub" >
            
          <li class="sub-item"><a href="#" class="sub-link">Shop Add</a></li>

            <li class="sub-item"><a href="#" class="sub-link">Shop List</a></li>

            
          </ul>
        </li>
        <!---------- Subscriber Menu-------------->
        <li class="br-menu-item">
          <a href="{{ route('admin.dashboard') }}" class="br-menu-link  {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Subscriber </span>
          </a>
        </li>
         <!---------- Settings Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link ">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Business Settings</span>
          </a>
        </li>
      </ul><!-- br-sideleft-menu -->

      <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-success">System Information</label>

      <div class="info-list">
        <div class="info-list-item">
          <div>
            <p class="info-list-label">Memory Usage</p>
            <h5 class="info-list-amount">32.3%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- info-list-item -->

        <div class="info-list-item">
          <div>
            <p class="info-list-label">CPU Usage</p>
            <h5 class="info-list-amount">140.05</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div><!-- info-list-item -->

        <div class="info-list-item">
          <div>
            <p class="info-list-label">Disk Usage</p>
            <h5 class="info-list-amount">82.02%</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div><!-- info-list-item -->

        <div class="info-list-item">
          <div>
            <p class="info-list-label">Daily Traffic</p>
            <h5 class="info-list-amount">62,201</h5>
          </div>
          <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
        </div><!-- info-list-item -->
      </div><!-- info-list -->

      <br>
    </div><!-- br-sideleft -->
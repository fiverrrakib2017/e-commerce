@php 
$route = Route::currentRouteName()
@endphp
<div class="br-logo"><a href=""><span>[</span>Pointsoft <i>plus</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Menu</label>
      <ul class="br-sideleft-menu">

        <li class="br-menu-item">
          <a href="{{ route('admin.dashboard') }}" class="br-menu-link  {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
        
        <!----------Blog  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/blog')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Blog </span>
          </a>
          <ul class="br-menu-sub" >
            <li class="sub-item"><a href="{{route('admin.blog.category.index')}}" class="sub-link {{ ($route == 'admin.blog.category.index')? 'active':'' }}">Manage Category</a></li>
            <li class="sub-item"><a href="{{route('admin.blog.create')}}" class="sub-link {{ ($route == 'admin.blog.create')? 'active':'' }}">Add Blog</a></li>

            <li class="sub-item"><a href="{{route('admin.blog.index')}}" class="sub-link {{ ($route == 'admin.blog.index'||$route == 'admin.blog.edit')? 'active':'' }}">Manage Blog</a></li>
          </ul>
        </li>
        <!----------Address  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/address')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Address </span>
          </a>
          <ul class="br-menu-sub" >
            <li class="sub-item"><a href="{{route('admin.address.country.index')}}" class="sub-link {{ ($route == 'admin.address.country.index' )? 'active':'' }}">Country List</a></li>
            <li class="sub-item"><a href="{{route('admin.address.state.index')}}" class="sub-link {{ ($route == 'admin.address.state.index' )? 'active':'' }}">State List</a></li>
            <li class="sub-item"><a href="{{route('admin.address.city.index')}}" class="sub-link {{ ($route == 'admin.address.city.index' )? 'active':'' }}">City List</a></li> 
            <li class="sub-item"><a href="{{route('admin.address.index')}}" class="sub-link {{ ($route == 'admin.address.index' )? 'active':'' }}">Add Address</a></li>            
          </ul>
        </li>
        <!----------Page Builder  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/landing_page')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Landing Page Management </span>
          </a>
          <ul class="br-menu-sub">

            <li class="sub-item"><a href="{{route('admin.landing_page.create')}}" class="sub-link {{ ($route == 'admin.landing_page.create' )? 'active':'' }}">Create Landing Page</a></li>

            <li class="sub-item"><a href="{{route('admin.landing_page.index')}}" class="sub-link {{ ($route == 'admin.landing_page.index' )? 'active':'' }}">Landing Page List</a></li>   
                    
          </ul>
        </li>
        <label class="sidebar-label pd-x-10 mg-t-20 op-3">Inventory</label>
        <!----------Customer  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/customer')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Customer</span>
          </a>
          <ul class="br-menu-sub" >
            
          <li class="sub-item"><a href="{{route('admin.customer.create')}}" class="sub-link {{ ($route == 'admin.customer.create')? 'active':'' }}">Add Customer</a></li>

            <li class="sub-item"><a href="{{route('admin.customer.index')}}" class="sub-link {{ ($route == 'admin.customer.index')? 'active':'' }}">Customer Management</a></li>

            <li class="sub-item"><a href="{{route('admin.customer.invoice.create_invoice')}}" class="sub-link {{ ($route == 'admin.customer.invoice.create_invoice')? 'active':'' }}">Invoice Create</a></li>

            <li class="sub-item"><a href="{{route('admin.customer.invoice.show_invoice')}}" class="sub-link {{ ($route == 'admin.customer.invoice.show_invoice'|| 'admin.customer.invoice.edit_invoice' ||'admin.customer.invoice.view_invoice')? 'active':'' }}">Invoice Management</a></li>

            
          </ul>
        </li>
        <!----------Supplier  Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/supplier')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Supplier</span>
          </a>
          <ul class="br-menu-sub" >
            <li class="sub-item"><a href="{{route('admin.supplier.create')}}" class="sub-link {{ ($route == 'admin.supplier.create')? 'active':' ' }}">Add Supplier</a></li>

            <li class="sub-item"><a href="{{route('admin.supplier.index')}}" class="sub-link {{ ($route == 'admin.supplier.index'|| 'admin.supplier.edit')? 'active':'' }}">Supplier Management</a></li>

            <li class="sub-item"><a href="{{route('admin.supplier.invoice.create_invoice')}}" class="sub-link {{ ($route == 'admin.supplier.invoice.create_invoice')? 'active':' ' }}">Invoice Create</a></li>

            <li class="sub-item"><a href="{{route('admin.supplier.invoice.show_invoice')}}" class="sub-link {{ ($route == 'admin.supplier.invoice.show_invoice'|| 'admin.supplier.invoice.edit_invoice' ||'admin.supplier.invoice.view_invoice')? 'active':'' }}">Invoice Management</a></li>            
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
          <a href="{{route('admin.order.index')}}" class="br-menu-link {{ Route::is('admin.order.index') ? 'active' : '' }}">
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

            <li class="sub-item"><a href="{{route('admin.seller.withdraw.approve.index')}}" class="sub-link {{ ($route == 'admin.seller.withdraw.approve.index')? 'active':'' }}">Withdraw Approved</a></li>

            <li class="sub-item"><a href="{{route('admin.seller.withdraw.reject.index')}}" class="sub-link {{ ($route == 'admin.seller.withdraw.reject.index')? 'active':'' }}">Withdraw Reject</a></li>
            
            <li class="sub-item"><a href="{{route('admin.seller.review.index')}}" class="sub-link {{ ($route == 'admin.seller.review.index')? 'active':'' }}">Seller Review</a></li>

            <li class="sub-item"><a href="#" class="sub-link ">Seller Invoice</a></li>

          </ul>
        </li>
        <!----------Shop Management Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/shop')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Shop </span>
          </a>
          <ul class="br-menu-sub" >

            <li class="sub-item"><a href="{{route('admin.pickup.index')}}" class="sub-link {{ ($route == 'admin.pickup.index')? 'active':'' }}">Pickup Point</a></li>

            <li class="sub-item"><a href="{{route('admin.staff.index')}}" class="sub-link {{ ($route == 'admin.staff.index')? 'active':'' }}">Staff List</a></li>

            <li class="sub-item"><a href="{{route('admin.shop.create')}}" class="sub-link {{ ($route == 'admin.shop.create')? 'active':'' }}">Shop Add</a></li>

            <li class="sub-item"><a href="{{route('admin.shop.index')}}" class="sub-link {{ ($route == 'admin.shop.index')? 'active':'' }}">Shop Management</a></li>

            
          </ul>
        </li>
        <label class="sidebar-label pd-x-10 mg-t-20 op-3">Accounts</label>
        <!----------Home Page Management Menu-------------->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{($prefix=='admin/home_page')?'show-sub':''}}">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Home Page </span>
          </a>
          <ul class="br-menu-sub" >

            <li class="sub-item"><a href="{{route('admin.pickup.index')}}" class="sub-link {{ ($route == 'admin.pickup.index')? 'active':'' }}">Hero Section </a></li>

            <li class="sub-item"><a href="{{route('admin.home_page.about.index')}}" class="sub-link {{ ($route == 'admin.home_page.about.index')? 'active':'' }}">About Section </a></li>

            <li class="sub-item"><a href="{{route('admin.home_page.contract.index')}}" class="sub-link {{ ($route == 'admin.home_page.contract.index')? 'active':'' }}">Contract </a></li>

            
          </ul>
        </li>
        <!---------- Subscriber Menu-------------->
        <li class="br-menu-item">
          <a href="{{ route('admin.subscriber.index') }}" class="br-menu-link  {{ Route::is('admin.subscriber.index') ? 'active' : '' }}">
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
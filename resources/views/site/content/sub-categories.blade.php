 
          @forelse ($categories as $category)
          <div class="col-6 col-sm-4 col-md-3 col-lg-6 mb-4 p-1">
            <a href="{{ $category['urlpath'] }}" class="category-link">
              <div class="category-card">
                <img src="{{ $category['image_path'] }}" alt="{{ $category['tr_title']}}">
                <div class="category-overlay">
                  <h6>{{ $category['tr_title'] }}</h6>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="row ques-row">
            <div class="col-12 text-center mb-4">
             <p>لايوجد اقسام</p>
            </div>
          
          </div>
          @endforelse      
		       <!-- قسم 2 -->
               @if ($categories->first())
               @if (Auth::guard('client')->check())
               <div class="row ques-row">
                   <div class="col-12 text-center mb-4">
                    <p>اختر قسم وابدأ الاختبار</p>
                   </div>
                 
                 </div>
                 @else
                 <div class="row ques-row">
                   <div class="col-12 text-center mb-4">
                    <p>سجل دخول لتستطيع المشاركة بالاختبار</p>
                   </div>
                 
                 </div>
               @endif 
               @endif  
		 

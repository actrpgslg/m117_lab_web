<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ URL::to('/')}}" class="simple-text">
               <i class="pe-7s-coffee"></i>
                M117 Lab 精神時光屋
            </a>
        </div>

        <ul class="nav">
            <li class="active">
                <a href="{{ URL::to('/')}}">
                    <i class="pe-7s-clock"></i>
                    <p>公佈欄</p>
                </a>
            </li>
            <li class="active">
                <a href="{{ URL::to('/home/Timeline')}}">
                    <i class="pe-7s-date"></i>
                    <p>研究室時間軸</p>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/history')}}">
                    <i class="pe-7s-download"></i>
                    <p>歷史資料下載</p>
                </a>
            </li>
        </ul>
    </div>
</div>
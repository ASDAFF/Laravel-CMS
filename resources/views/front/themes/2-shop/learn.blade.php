@php
$properties = [
	[
		'title' => 'مشتری وفادار',
		'description' => 'بیشتر
با شناخت مشتریانتان و داشتن راه ارتباطی موثر با
آن‌ها می‌توانید مشتریان خود را بهتر شناخته و با اجرای برنامه‌های وفاداری
خلاقانه و جذاب، آنها را به برند خود وفادار کنید.',
	],
	[
		'title' => 'کاهش هزینه',
		'description' => 'حذف هزینه چاپ مجدد و مداوم منو با تغییر قیمت‌ها،
تغییر آیتم‌ها، فرسوده شدن منو و ... زیرا در مِ‌نیو در کمتر از 5 دقیقه هر تغییری
از جمله تغییر قیمت‌ها را می‌توانید به سادگی اعمال کنید.',
	],
	[
		'title' => 'افزایش درآمد',
		'description' => 'منوی دیجیتال شما و مشتریانتان اکنون مارکترهای
شما هستند، مشتری وفادار و راضی بیشتر در نتیجه درآمد بیشتر',
	],
	[
		'title' => 'مدیریت بهتر رستوران',
		'description' => 'دیدن گزارشات تصویری و گویا از نظرات مشتریان،
تحلیل آن‌ها و راهکارهایی برای بهبود نواقص (امکان مشاهده جزئیات حضور و سفارش هریک و برقراری ارتباط در صورت نیاز) و نقاط قوت، کنترل کلیه شعب در یک پنل
مدیریتی',
	],
	[
		'title' => 'مشتری راضی بیشتر',
		'description' => 'این منو مناسب این نسل است(
مطابق عادت مشتری امروز) و با احتمال بیشتری از انتخابش رضایت دارد زیرا هوشمندانه تر سفارش داده(دیدن عکس غذاها و توضیحات کاربردی)، به نظراتش اهمیت داده می‌شود و گارسون‌ها
زمان بیشتر برای ارائه خدمات بهتر
 به او دارند',
	],
	[
		'title' => 'مشتری راضی بیشتر',
		'description' => 'این منو مناسب این نسل است(
مطابق عادت مشتری امروز) و با احتمال بیشتری از انتخابش رضایت دارد زیرا هوشمندانه تر سفارش داده(دیدن عکس غذاها و توضیحات کاربردی)، به نظراتش اهمیت داده می‌شود و گارسون‌ها
زمان بیشتر برای ارائه خدمات بهتر
 به او دارند',
	],
];
@endphp
<div class="container pt-5 bg-white">
	<div class="row">
		<div class="col-12 mt-5 text-center">
			<h1 class="m-3 mt-5" style="font-size: 20px; line-height: 33px;">
			.مِ‌نیو منوی دیجیتال در گوشی همراه شماست 
			<br>
				بدون اینکه بخواهید اپلیکیشنی را دانلود کنید، کافیست یک کد کیو آر را اسکن کرده 
			<br>
				.و منوی پرمحتوا، جذاب و متفاوت از منوی کاغذی را مشاهده کنید
			</h1>
		</div>
	</div>
	<div class="row rtl-text-right">
		@foreach($properties as $property)
		<div class="col-sm-6 mt-3">
			<h5>{{ $property['title'] }}</h5>
			<p>{{ $property['description'] }}</p>
		</div>
		@endforeach
	</div>
</div>
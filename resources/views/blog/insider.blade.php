@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<div class="col-12 insider-main">
			@if(Session::has('flash_message'))
				<div class="alert alert-success" role="alert">
					{{ session('flash_message') }}
				</div>
			@endif
			<h1>#<span style="color: #B00000;">Я</span>ИНСАЙДЕР - поделись своим секретом</h1>
			<div class="mb-4 mt-4">
				<h4>Если ты сюда кликнул, значит, у тебя есть инсайдерская информация или любопытная тема для крутого материала. Постарайся максимально чётко описать суть идеи/инсайда по специальной форме.</h4>

				<h4>Укажи свои контактные данные, если для этого есть необходимость. Мы гарантируем полную анонимность при нашем разговоре.</h4>

				<h4>Лучшие материалы будут вознаграждаться символической оплатой. Дерзай! 😉 </h4>
			</div>
			<form action="{{route('insider.add')}}" class="form-horizontal" method="post" name="review-form">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="">Автор</label>
					<input type="text" class="form-control" name="author" placeholder="Имя/никнейм. Можно остаться анонимным" required>
				</div>
				<div class="form-group">
					<label for="">Заголовок</label>
					<input type="text" class="form-control" name="title" placeholder="Тема материала или инсайда" required>
				</div>
				<div class="form-group">
					<label for="">Текст материала</label>
					<textarea id="description" type="text" class="form-control" name="description"></textarea>
				</div>
				<div class="form-group">
					<div id="g-captcha" class="g-recaptcha"></div>
				</div>
				<button class="btn btn-primary insider-main__button" type="submit">Отправить материал</button>
			</form>
		</div>
	</div>
</div>

@endsection

@section('footer-other')

	<script src="https://cdn.tiny.cloud/1/7i51jw4i37n4xfqk7dax6flunh299ln0elzdie3yrfystlr8/tinymce/4/tinymce.min.js"></script>
	<script src="{{asset('js/tinymce.js')}}"></script>
	<script src="{{asset('js/ru.js')}}"></script>
 	<script src='https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit'></script>
	
    <script>
        var RC2KEY = '6Lfug6oUAAAAAEqB84TC-1r5b1dLvYzvs8rnpJ8_',
        doSubmit = false;

        function reCaptchaVerify(response) {
            if (response === document.querySelector('.g-recaptcha-response').value) {
                doSubmit = true;
            }
        }

        function reCaptchaExpired () {
            /* do something when it expires */
        }

        function reCaptchaCallback () {
            /* this must be in the global scope for google to get access */
            grecaptcha.render('g-captcha', {
                'sitekey': RC2KEY,
                'callback': reCaptchaVerify,
                'expired-callback': reCaptchaExpired
            });

            document.forms['review-form'].addEventListener('submit',function(e){
            if (doSubmit == false) {
                event.preventDefault(); 
                alert('Пройдите проверку на робота!');
            }
        	});
        }

       
    </script>

@endsection


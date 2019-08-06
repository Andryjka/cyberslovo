@extends('layouts.app')

@section('content')
<div id="token"></div>
@endsection

@section('footer-other')

<script type="text/javascript">
	//сохранение токена
	function SendTokenToServer(currentToken) {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				console.log(this.responseText);
			}
		}
		xmlhttp.open("GET","savetoken.php?token="+currentToken,true);
		xmlhttp.send();
	}
</script>
<script src="https://www.gstatic.com/firebasejs/6.3.1/firebase.js"></script>

<script  type="text/javascript">
		var config = {
			apiKey: "AIzaSyCxuypYOyrsJvjhg0BpQ6ASNiodW1dD_E8",
		    authDomain: "cyberslovo-cloud-messaging.firebaseapp.com",
		    databaseURL: "https://cyberslovo-cloud-messaging.firebaseio.com",
		    projectId: "cyberslovo-cloud-messaging",
		    storageBucket: "",
		    messagingSenderId: "381223654567",
		    appId: "1:381223654567:web:f443a24b81f02e0e"
		};

		//инициализируем подключение к FCM
		firebase.initializeApp(config);
		const messaging = firebase.messaging();
		document.getElementById('token').innerHTML = 'NO LOAD TOKEN';

		//запрос на показ Web-PUSH браузеру
		messaging.requestPermission()
		.then(function() {
			console.log('Notification permission granted.');
			// Если нотификация разрешена, получаем токен.
			messaging.getToken()
			.then(function(currentToken) {
				if (currentToken) {
					console.log(currentToken);
					//отправка токена на сервер
					SendTokenToServer(currentToken);
					document.getElementById('token').innerHTML = currentToken;
				} else {
					console.log('No Instance ID token available. Request permission to generate one.');
				}
			})
			.catch(function(err) {
				console.log('An error occurred while retrieving token. ', err);
			});
		})
		.catch(function(err) {
			console.log('Unable to get permission to notify.', err);
		});

		messaging.onMessage(function(payload) {
			console.log('Message received. ', payload);
			// регистрируем пустой ServiceWorker каждый раз
			navigator.serviceWorker.register('//cyberslovo.ru/firebase-messaging-sw.js');
			// запрашиваем права на показ уведомлений если еще не получили их
			Notification.requestPermission(function(result) {
				if (result === 'granted') {
					navigator.serviceWorker.ready.then(function(registration) {
						// теперь мы можем показать уведомление
						return registration.showNotification(payload.notification.title, payload.notification);
					}).catch(function(error) {
						console.log('ServiceWorker registration failed', error);
					});
				}
			});
		});
	</script>

@endsection

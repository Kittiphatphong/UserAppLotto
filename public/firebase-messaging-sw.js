/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.5/firebase-analytics.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyAaoMWxQYmJ8cIB337xN2BRnvH-U8mRG58",
    authDomain: "user-final-app.firebaseapp.com",
    projectId: "user-final-app",
    storageBucket: "user-final-app.appspot.com",
    messagingSenderId: "389780167948",
    appId: "1:389780167948:web:fcbc78e42c03aa3b46fd29",
    measurementId: "G-ZFSYSVFREW"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});

<!DOCTYPE html>
<html>
<head>
    <title>تأكيد استلام الطلب</title>
</head>
<body>
    <h1>مرحبًا {{ $contact->first_name }}!</h1>
    <p>لقد استلمنا طلبك بنجاح.</p>
    <p>رقم الهاتف: {{ $contact->phone_number }}</p>
    <p>الوصف: {{ $contact->description }}</p>
</body>
</html>

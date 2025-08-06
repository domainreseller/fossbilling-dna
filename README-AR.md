<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# وحدة DomainNameApi لـ FOSSBilling

هذه الوحدة هي التكامل الرسمي لـ DomainNameApi مع FOSSBilling. يمكنك إدارة تسجيل النطاقات ونقلها وتجديدها وإدارتها مباشرة من لوحة تحكم FOSSBilling.

## المتطلبات

- FOSSBilling 1.0 أو أحدث
- PHP 8.0 أو أحدث
- يجب تفعيل امتداد PHP SOAP

## التثبيت

1. قم برفع مجلد الوحدة إلى `library/Registrar/Adapter/` في تثبيت FOSSBilling الخاص بك.
2. سجل الدخول إلى لوحة تحكم FOSSBilling.
3. انتقل إلى الإعدادات > وحدات تسجيل النطاقات وقم بتفعيل "DomainNameApi".
4. أدخل اسم المستخدم وكلمة المرور الخاصة بـ DomainNameApi API.
5. احفظ وابدأ في استخدام الوحدة.

## التحديث

- قم بتنزيل أحدث إصدار واستبدل الملفات الحالية.
- ستبقى إعداداتك محفوظة، وسيتم تحديث الكود فقط.

## الميزات

- تسجيل، نقل وتجديد النطاقات
- إدارة خوادم الأسماء (DNS)
- تحديث معلومات Whois/الاتصال
- قفل/فتح قفل النطاق (Registrar Lock)
- خصوصية Whois (حماية الخصوصية)
- دعم كامل لنطاقات .TR
- تسجيل الأخطاء والعمليات
- دعم متعدد اللغات (بما في ذلك العربية)

## رموز الأخطاء الشائعة

| الكود  | الشرح                                           | التفاصيل                                                                                 |
|--------|-------------------------------------------------|------------------------------------------------------------------------------------------|
| 1000   | تمت العملية بنجاح                               | تم تنفيذ الأمر بنجاح                                                                    |
| 1001   | تمت العملية بنجاح؛ الإجراء قيد الانتظار          | تم التنفيذ بنجاح، لكن الإجراء في قائمة الانتظار                                          |
| 2003   | معلومة مفقودة مطلوبة                            | مثال: رقم الهاتف مفقود في معلومات الاتصال                                               |
| 2105   | الكائن غير مؤهل للتجديد                         | النطاق مقفل للتحديث، يجب ألا تكون الحالة "clientupdateprohibited"                      |
| 2200   | خطأ في المصادقة                                 | اسم المستخدم/كلمة المرور لـ API غير صحيح أو النطاق مسجل لدى مسجل آخر                   |
| 2302   | الكائن موجود بالفعل                             | النطاق أو خادم الأسماء موجود بالفعل في قاعدة البيانات                                   |
| 2303   | الكائن غير موجود                                | النطاق أو خادم الأسماء غير موجود، يجب إنشاء تسجيل جديد                                  |
| 2304   | حالة الكائن تمنع العملية                        | النطاق مقفل للتحديث، يجب ألا تكون الحالة "clientupdateprohibited"                      |

## الدعم والمساهمة

- [الموقع الرسمي لـ FOSSBilling](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- الدعم: support@domainnameapi.com

---

> للغات الأخرى، انقر على الأعلام أعلاه. كل لغة تحتوي على محتوى وتفاصيل تقنية محدثة.

# 📋 دليل التغييرات الكامل — Middleware + Roles & Users Management + Sidebar Layout

> هذا الملف يشرح كل شيء تم عمله بالتفصيل، ملف ملف، مع تعليمات التجربة.

---

## 📌 ملخص سريع

تم إنجاز 4 مهام:

| # | المهمة | الوصف |
|---|--------|-------|
| 1 | **EnsureUserIsActive Middleware** | ميدلوير يمنع المستخدمين غير النشطين من الوصول للداشبورد |
| 2 | **إدارة الأدوار (Roles)** | صفحات CRUD كاملة لإدارة الأدوار والصلاحيات |
| 3 | **إدارة المستخدمين (Users)** | صفحات CRUD كاملة لإدارة المستخدمين مع تعيين الأدوار |
| 4 | **تعديل الـ Layout للسايدبار** | إلغاء الهيدر العلوي وتحويله لسايدبار جانبي شامل لروابط الأدمن |

---

---


# 🔐 المهمة 1: EnsureUserIsActive Middleware

## الهدف
فقط المستخدمين اللي حالتهم `active` يقدروا يدخلوا الداشبورد. أي مستخدم حالته `inactive` أو `suspended` يطلعله خطأ 403.

---

### ملف جديد: `app/Http/Middleware/EnsureUserIsActive.php`

```php
public function handle(Request $request, Closure $next): Response
{
    $user = $request->user();

    if ($user && $user->status !== 'active') {
        abort(403, 'Your account is not active.');
    }

    return $next($request);
}
```

**شو بيعمل؟**
- بياخد المستخدم الحالي من الـ request
- بيتحقق إذا الـ `status` تبعه مش `active`
- إذا مش نشط → يرجع خطأ **403 Forbidden** مع رسالة "Your account is not active."
- إذا نشط → بيكمل الطلب عادي

---

### ملف معدّل: `bootstrap/app.php`

**التغيير:** تم إضافة سطرين:

```diff
+ use App\Http\Middleware\EnsureUserIsActive;

  $middleware->alias([
      'type' => EnsureUserType::class,
+     'active' => EnsureUserIsActive::class,
  ]);
```

**شو عملنا؟**
- استوردنا الكلاس الجديد
- سجلنا الميدلوير باسم مستعار `active` عشان نقدر نستخدمه بالراوتات

---

### ملف معدّل: `routes/web.php`

**التغيير 1:** أضفنا `'active'` لمجموعة راوتات الداشبورد:

```php
Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard/',
    'middleware' => ['auth:web', 'verified', 'active'],  // ← تمت الإضافة هنا
], function () {
    // ... كل راوتات الداشبورد
});
```

**التغيير 2:** أنشأنا مجموعة راوتات جديدة للأدمن:

```php
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin/',
    'middleware' => ['auth', 'type:super-admin,admin', 'active'],
], function () {
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('users', UserController::class);
});
```

**شو عملنا؟**
- كل راوتات `/dashboard/*` صارت تمر بميدلوير `active`
- أنشأنا مجموعة `/admin/*` جديدة فيها:
  - `auth` → لازم يكون مسجل دخول
  - `type:super-admin,admin` → لازم يكون أدمن أو سوبر أدمن
  - `active` → لازم حالته نشطة

---

### 🧪 كيف تجرب المهمة 1؟

1. **غيّر حالة مستخدم في قاعدة البيانات:**
   ```sql
   UPDATE users SET status = 'inactive' WHERE id = 1;
   ```
2. **سجل دخول بهذا المستخدم وحاول تفتح:**
   - `http://localhost/dashboard/posts` → لازم يطلع **403**
   - `http://localhost/admin/users` → لازم يطلع **403**
3. **رجّع الحالة لـ active:**
   ```sql
   UPDATE users SET status = 'active' WHERE id = 1;
   ```
4. **حاول تاني** → لازم يفتح عادي ✅

---

---

# 🛡️ المهمة 2: إدارة الأدوار (Roles)

## الهدف
صفحات لإنشاء وتعديل وحذف الأدوار (Roles). كل دور عنده اسم ومجموعة صلاحيات (abilities).

---

### ملف جديد: `app/Http/Controllers/AdminDashboard/RoleController.php`

**الميثودات:**

| Method | Route | شو بيعمل |
|--------|-------|----------|
| `index()` | `GET /admin/roles` | يعرض كل الأدوار مع عدد المستخدمين لكل دور |
| `create()` | `GET /admin/roles/create` | يعرض فورم إنشاء دور جديد مع قائمة الصلاحيات |
| `store()` | `POST /admin/roles` | يحفظ الدور الجديد بعد التحقق (validation) |
| `edit($role)` | `GET /admin/roles/{role}/edit` | يعرض فورم التعديل مع البيانات الحالية |
| `update($role)` | `PUT /admin/roles/{role}` | يحدّث الدور بعد التحقق |
| `destroy($role)` | `DELETE /admin/roles/{role}` | يحذف الدور |

**Validation Rules:**
```php
'name' => 'required|string|max:255|unique:roles,name'  // فريد
'abilities' => 'nullable|array'                          // مصفوفة اختيارية
'abilities.*' => 'string'                                // كل عنصر لازم يكون نص
```

**ملاحظة:** الصلاحيات المتاحة بتيجي من ملف `config/abilities.php`:
```php
return [
    'users.view' => 'View users',
    'users.create' => 'Create user',
    'users.update' => 'Update user',
    'users.delete' => 'Delete user',
];
```

---

### ملف جديد: `resources/views/admin/roles/index.blade.php`

**شو فيه؟**
- **هيدر** مع عنوان "Role Management" وزر "Create Role"
- **رسالة نجاح** تظهر بعد أي عملية (إنشاء/تعديل/حذف)
- **بطاقات (Cards)** لكل دور:
  - اسم الدور
  - عدد المستخدمين المعينين
  - الصلاحيات كـ badges ملونة
  - تاريخ الإنشاء
  - أزرار تعديل وحذف (تظهر عند hover)
- **بطاقة "Add New Role"** فارغة مع أيقونة +
- **جدول** تحت البطاقات يعرض كل الأدوار بشكل مفصل

---

### ملف جديد: `resources/views/admin/roles/_form.blade.php`

**شو فيه؟**
- فورم مشترك بين الإنشاء والتعديل
- **حقل الاسم** — input text
- **الصلاحيات** — grid من checkboxes، كل واحد يعرض:
  - اسم الصلاحية (مثلاً "View users")
  - الـ key تبعها (مثلاً `users.view`)
- عرض أخطاء الـ validation
- أزرار Cancel و Save/Update

**كيف بيفرق بين الإنشاء والتعديل؟**
```php
// إذا الـ role عنده id → يعني تعديل
{{ isset($role->id) ? 'Edit Role' : 'Create Role' }}
```

---

### ملف جديد: `resources/views/admin/roles/create.blade.php`

```blade
<x-layout title="Create Role">
    @include('admin.roles._form')
</x-layout>
```
بس wrapper بسيط بيحمّل الفورم بدون بيانات.

---

### ملف جديد: `resources/views/admin/roles/edit.blade.php`

```blade
<x-layout title="Edit Role">
    @include('admin.roles._form', [
        'action' => route('admin.roles.update', $role),
        'method' => 'PUT',
    ])
</x-layout>
```
بيحمّل نفس الفورم بس مع action للـ update و method PUT.

---

### 🧪 كيف تجرب المهمة 2؟

1. **افتح صفحة الأدوار:**
   - من السايدبار الجانبي، بقسم Administration اضغط على Roles (أو ادخل الرابط `http://localhost:8000/admin/roles`)
   → لازم تشوف الصفحة فاضية أو فيها أدوار موجودة

2. **أنشئ دور جديد:**
   - اضغط "Create Role"
   - اكتب اسم مثل: `Editor`
   - اختر صلاحيات: ✅ View users, ✅ Update user
   - اضغط "Create Role"
   → لازم يرجعك لصفحة الأدوار مع رسالة نجاح

3. **عدّل دور:**
   - اضغط أيقونة القلم ✏️ على أي دور
   - غيّر الاسم أو الصلاحيات
   - اضغط "Update Role"

4. **احذف دور:**
   - اضغط أيقونة الحذف 🗑️
   - اضغط OK في التأكيد
   → لازم ينحذف ويظهر رسالة نجاح

---

---

# 👥 المهمة 3: إدارة المستخدمين (Users)

## الهدف
صفحات لإدارة المستخدمين — إنشاء، تعديل، حذف، تعيين أدوار.

---

### ملف معدّل: `app/Http/Controllers/AdminDashboard/UserController.php`

**تم إعادة كتابته بالكامل.** كان يرجع `__METHOD__` بس، الآن فيه CRUD كامل.

| Method | Route | شو بيعمل |
|--------|-------|----------|
| `index()` | `GET /admin/users` | يعرض كل المستخدمين مع أدوارهم (paginated - 10 بالصفحة) |
| `create()` | `GET /admin/users/create` | يعرض فورم إنشاء مستخدم مع قائمة الأدوار |
| `store()` | `POST /admin/users` | يحفظ المستخدم + يعيّن الأدوار (sync) |
| `show($user)` | `GET /admin/users/{user}` | يعرض تفاصيل مستخدم |
| `edit($user)` | `GET /admin/users/{user}/edit` | يعرض فورم التعديل |
| `update($user)` | `PUT /admin/users/{user}` | يحدّث المستخدم + يعيّن الأدوار |
| `destroy($user)` | `DELETE /admin/users/{user}` | يحذف المستخدم ويفصل أدواره |

**Validation عند الإنشاء:**
```php
'name'     => 'required|string|max:255'
'email'    => 'required|email|unique:users,email'
'username' => 'required|string|max:255|unique:users,username'
'password' => 'required|string|min:8|confirmed'    // لازم يكون مع تأكيد
'status'   => 'required|in:active,inactive,suspended'
'type'     => 'required|in:user,admin,super-admin'
'roles'    => 'nullable|array'
'roles.*'  => 'exists:roles,id'                    // كل دور لازم يكون موجود
```

**Validation عند التعديل:**
- نفس الشيء بس:
  - `email` و `username` → unique مع استثناء المستخدم الحالي
  - `password` → **اختياري** (nullable) — لو تركته فاضي ما يتغير

**تعيين الأدوار:**
```php
$user->roles()->sync($data['roles']);  // بيحذف الأدوار القديمة ويحط الجديدة
```

---

### ملف جديد: `resources/views/admin/users/index.blade.php`

**شو فيه؟**
- **هيدر** مع عنوان "User Management" وزر "Create User"
- **رسالة نجاح** خضراء
- **جدول** فيه أعمدة:

| العمود | الوصف |
|--------|-------|
| User | صورة المستخدم (أو حرفين من اسمه) + الاسم + @username |
| Email | إيميل المستخدم |
| Type | نوع الحساب بـ badge ملون: 🟣 super-admin, 🔵 admin, ⚪ user |
| Status | حالة الحساب بـ badge: 🟢 active, 🟡 inactive, 🔴 suspended |
| Roles | الأدوار المعينة كـ badges بنفسجية |
| Joined | تاريخ إنشاء الحساب |
| Actions | أزرار تعديل وحذف (تظهر عند hover) |

- **Pagination** تحت الجدول

---

### ملف جديد: `resources/views/admin/users/_form.blade.php`

**شو فيه؟**

فورم مشترك بين الإنشاء والتعديل، فيه:

1. **Full Name** — حقل نص
2. **Email + Username** — صف واحد، حقلين جنب بعض
3. **Password + Confirm Password** — صف واحد
   - في التعديل يظهر: "leave blank to keep current"
4. **Status + User Type** — صف واحد، قائمتين منسدلتين
   - Status: active / inactive / suspended
   - Type: user / admin / super-admin
5. **Assign Roles** — checkboxes لكل الأدوار المتاحة
   - كل checkbox يعرض اسم الدور + عدد صلاحياته
   - لو ما في أدوار → يظهر رابط "Create one first"
6. **أزرار** Cancel + Create/Update User

---

### ملف جديد: `resources/views/admin/users/create.blade.php`

```blade
<x-layout title="Create User">
    @include('admin.users._form')
</x-layout>
```

---

### ملف جديد: `resources/views/admin/users/edit.blade.php`

```blade
<x-layout title="Edit User">
    @include('admin.users._form', [
        'action' => route('admin.users.update', $user),
        'method' => 'PUT',
    ])
</x-layout>
```

---

### 🧪 كيف تجرب المهمة 3؟

1. **افتح صفحة المستخدمين:**
   - من السايدبار الجانبي، بقسم Administration اضغط على Users
   → لازم تشوف جدول فيه كل المستخدمين

2. **أنشئ مستخدم جديد:**
   - اضغط "Create User"
   - عبّي: الاسم، الإيميل، اليوزرنيم، الباسورد (8 أحرف على الأقل + تأكيد)
   - اختر Status: Active
   - اختر Type: user
   - اختر أدوار (لو في أدوار متاحة)
   - اضغط "Create User"

3. **عدّل مستخدم:**
   - اضغط أيقونة القلم ✏️
   - غيّر الاسم أو الإيميل
   - غيّر الأدوار المعينة
   - **الباسورد اختياري** — لو تركته فاضي ما يتغير
   - اضغط "Update User"

4. **احذف مستخدم:**
   - اضغط أيقونة الحذف 🗑️
   - اضغط OK
   → ينحذف المستخدم وأدواره تتفصل

5. **جرب تعيين أدوار متعددة:**
   - عدّل مستخدم
   - اختر أكثر من دور: ✅ Editor, ✅ Moderator
   - اضغط Update
   - ارجع لصفحة المستخدمين → لازم تشوف الأدوار كـ badges

---

---

# 📁 ملخص كل الملفات

## ملفات جديدة (11 ملف)

| الملف | الوصف |
|-------|-------|
| `app/Http/Middleware/EnsureUserIsActive.php` | ميدلوير التحقق من حالة المستخدم |
| `app/Http/Controllers/AdminDashboard/RoleController.php` | كونترولر إدارة الأدوار |
| `resources/views/admin/roles/index.blade.php` | صفحة عرض الأدوار |
| `resources/views/admin/roles/_form.blade.php` | فورم إنشاء/تعديل دور |
| `resources/views/admin/roles/create.blade.php` | صفحة إنشاء دور |
| `resources/views/admin/roles/edit.blade.php` | صفحة تعديل دور |
| `resources/views/admin/users/index.blade.php` | صفحة عرض المستخدمين |
| `resources/views/admin/users/_form.blade.php` | فورم إنشاء/تعديل مستخدم |
| `resources/views/admin/users/create.blade.php` | صفحة إنشاء مستخدم |
| `resources/views/admin/users/edit.blade.php` | صفحة تعديل مستخدم |

## ملفات معدّلة (8 ملفات)

| الملف | التغيير |
|-------|---------|
| `resources/views/layouts/front.blade.php` | تحويل الـ Header لـ Sidebar مع حماية الروابط بناءً على الصلاحيات |
| `bootstrap/app.php` | إضافة alias للميدلوير `active` |
| `routes/web.php` | إضافة ميدلوير `active` للداشبورد + مجموعة راوتات الأدمن |
| `app/Http/Controllers/AdminDashboard/UserController.php` | إعادة كتابة كاملة مع CRUD + role sync |
| `resources/views/admin/users/index.blade.php` | تقليل الـ Padding لأن السايدبار أخذ مكان الهيدر |
| `resources/views/admin/roles/index.blade.php` | تقليل الـ Padding |
| `resources/views/Dashboard/categories/index.blade.php` | تقليل الـ Padding |
| `resources/views/Dashboard/posts/index.blade.php` | تقليل الـ Padding |

---

# 🔗 كل الراوتات الجديدة

```
GET    /admin/roles              → صفحة عرض الأدوار
GET    /admin/roles/create       → فورم إنشاء دور
POST   /admin/roles              → حفظ دور جديد
GET    /admin/roles/{role}/edit  → فورم تعديل دور
PUT    /admin/roles/{role}       → تحديث دور
DELETE /admin/roles/{role}       → حذف دور

GET    /admin/users              → صفحة عرض المستخدمين
GET    /admin/users/create       → فورم إنشاء مستخدم
POST   /admin/users              → حفظ مستخدم جديد
GET    /admin/users/{user}       → عرض تفاصيل مستخدم
GET    /admin/users/{user}/edit  → فورم تعديل مستخدم
PUT    /admin/users/{user}       → تحديث مستخدم
DELETE /admin/users/{user}       → حذف مستخدم
```

**الميدلوير على كل هالراوتات:**
1. `auth` → لازم يكون مسجل دخول
2. `type:super-admin,admin` → لازم يكون أدمن أو سوبر أدمن
3. `active` → لازم حالته نشطة

---

# ⚡ خطوات التجربة السريعة

```bash
# 1. تأكد إنك عامل migrate
php artisan migrate

# 2. تأكد إن عندك مستخدم أدمن
# من tinker:
php artisan tinker
> $user = User::first();
> $user->type = 'super-admin';
> $user->status = 'active';
> $user->save();

# 3. شغل السيرفر
php artisan serve

# 4. سجل دخول وافتح الداشبورد
# رح تلاقي السايدبار الجانبي، وإذا كنت أدمن رح تلاقي قسم Administration اللي فيه Users و Roles
```

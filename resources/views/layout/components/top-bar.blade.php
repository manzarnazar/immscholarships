<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex items-center text-sm font-medium text-slate-700 dark:text-slate-300">
    <ol class="inline-flex items-center space-x-2">
        <li class="inline-flex items-center">
            <a href="/dashboard/home" class="inline-flex items-center hover:text-primary">
                <i data-feather="home" class="w-4 h-4 mr-1"></i> Application
            </a>
        </li>
        <li class="inline-flex items-center">
            <span class="mx-2 text-slate-400">/</span>
            <span class="text-primary font-semibold">Dashboard</span>
        </li>
    </ol>
</nav>
<!-- END: Breadcrumb -->

<!-- BEGIN: Search (Livewire-ready or JS-enhanced) -->
<div class="intro-x relative ml-auto mr-4 sm:mr-6">
    <div class="search hidden sm:block relative">
        <input type="text" class="search__input form-control border-transparent pl-10 pr-4 py-2 rounded-full shadow-sm focus:ring focus:border-primary" placeholder="Search...">
        <i data-feather="search" class="absolute left-3 top-2.5 w-4 h-4 text-slate-500"></i>
    </div>
    <div class="search-result absolute mt-2 bg-white dark:bg-darkmode-600 shadow-xl rounded-xl w-[380px] max-h-[70vh] overflow-y-auto hidden z-50">
        <div class="p-4">
            <div class="text-xs font-semibold uppercase text-slate-400 mb-2">Pages</div>
            <a href="#" class="flex items-center mb-3 hover:bg-slate-100 dark:hover:bg-darkmode-500 p-2 rounded-lg">
                <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                    <i class="w-4 h-4" data-feather="inbox"></i>
                </div>
                <div class="ml-3 text-sm">Mail Settings</div>
            </a>
            <a href="#" class="flex items-center mb-3 hover:bg-slate-100 dark:hover:bg-darkmode-500 p-2 rounded-lg">
                <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">
                    <i class="w-4 h-4" data-feather="users"></i>
                </div>
                <div class="ml-3 text-sm">Users & Permissions</div>
            </a>
            <a href="#" class="flex items-center mb-3 hover:bg-slate-100 dark:hover:bg-darkmode-500 p-2 rounded-lg">
                <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">
                    <i class="w-4 h-4" data-feather="credit-card"></i>
                </div>
                <div class="ml-3 text-sm">Transactions Report</div>
            </a>

            <div class="text-xs font-semibold uppercase text-slate-400 mt-4 mb-2">Users</div>
            @foreach (array_slice($fakers, 0, 4) as $faker)
                <a href="#" class="flex items-center mb-3 hover:bg-slate-100 dark:hover:bg-darkmode-500 p-2 rounded-lg">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Avatar" class="rounded-full" src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
                    </div>
                    <div class="ml-3 text-sm">{{ $faker['users'][0]['name'] }}</div>
                    <div class="ml-auto text-xs text-slate-500 text-right truncate w-32">{{ $faker['users'][0]['email'] }}</div>
                </a>
            @endforeach

            <div class="text-xs font-semibold uppercase text-slate-400 mt-4 mb-2">Products</div>
            @foreach (array_slice($fakers, 0, 4) as $faker)
                <a href="#" class="flex items-center mb-3 hover:bg-slate-100 dark:hover:bg-darkmode-500 p-2 rounded-lg">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Product" class="rounded-full" src="{{ asset('dist/images/' . $faker['images'][0]) }}">
                    </div>
                    <div class="ml-3 text-sm">{{ $faker['products'][0]['name'] }}</div>
                    <div class="ml-auto text-xs text-slate-500 text-right truncate w-32">{{ $faker['products'][0]['category'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
<!-- END: Search -->

   <!-- BEGIN: Notifications -->
@php
    $user = \App\Models\User::find(auth()->id());
@endphp

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="relative dropdown mr-4 sm:mr-6">
  <div class="dropdown-toggle cursor-pointer relative" role="button" aria-expanded="false" data-tw-toggle="dropdown">
    <div class="relative w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center shadow-md hover:scale-105 transition-transform">
      <i data-feather="bell" class="w-5 h-5 text-white"></i>
      @if($user->unreadNotifications->isNotEmpty())
        <span id="mainBellDot" class="absolute top-0 right-0 w-2 h-2 bg-yellow-400 border-2 border-white rounded-full"></span>
      @endif
    </div>
  </div>

  <div class="dropdown-menu w-[420px] mt-3 p-5 bg-gradient-to-br from-white via-slate-100 to-slate-200 dark:from-darkmode-600 dark:via-darkmode-700 dark:to-darkmode-800 rounded-3xl shadow-2xl max-h-[80vh] overflow-y-auto z-50 space-y-5 animate__animated animate__fadeInRight animate__faster">
    <div class="text-xl font-bold text-indigo-800 dark:text-white mb-2">Your Notifications</div>

    @forelse($user->notifications as $notification)
      @php
        $data = $notification->data;
        $isUnread = is_null($notification->read_at);
        $avatar = $data['image_path'] ?? asset('default-avatar.png');
        $bgColor = $isUnread ? 'bg-white dark:bg-darkmode-500 border border-indigo-100 dark:border-darkmode-400' : 'bg-slate-100 dark:bg-darkmode-700';
      @endphp

      <div 
        class="relative flex items-start gap-4 p-4 {{ $bgColor }} rounded-xl shadow-sm hover:shadow-md cursor-pointer transition-all duration-300 group hover:scale-[1.01]"
        onclick="openNotificationModal({{ json_encode([
          'title' => $data['student_name'] ?? 'Notification',
          'message' => $data['message'] ?? 'No message',
          'time' => $notification->created_at->format('M d, Y h:i A'),
          'id' => $notification->id
        ]) }})"
        id="notif-card-{{ $notification->id }}"
      >
        <div class="w-12 h-12 rounded-full overflow-hidden border border-white shadow-md">
          <img src="{{ $avatar }}" alt="Avatar" class="w-full h-full object-cover" />
        </div>

        <div class="flex-1 min-w-0">
          <div class="flex justify-between items-center">
            <h4 class="text-base font-semibold text-indigo-800 dark:text-white truncate">
              {{ $data['student_name'] ?? 'Unnamed' }}
            </h4>
            <span class="text-xs text-slate-500 dark:text-slate-400">{{ $notification->created_at->diffForHumans() }}</span>
          </div>
          <p class="text-sm text-slate-700 dark:text-slate-300 mt-1 group-hover:line-clamp-none line-clamp-2 transition-all">
            {{ $data['message'] ?? 'No message available.' }}
          </p>
        </div>
      </div>
    @empty
      <div class="text-center text-slate-500 text-sm py-6">No notifications found.</div>
    @endforelse

    @if($user->unreadNotifications->isNotEmpty())
      <div class="pt-3 text-center border-t border-slate-200 dark:border-darkmode-400">
        <button onclick="markAllAsRead()" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">Mark All as Read</button>
      </div>
    @endif
  </div>
</div>

<!-- Modal -->
<div id="notificationModal" class="fixed inset-0 z-[100] bg-black/40 backdrop-blur-md hidden items-center justify-center px-4">
  <div class="bg-white dark:bg-darkmode-600 w-full max-w-lg p-6 rounded-3xl shadow-2xl relative animate__animated animate__fadeInUp animate__faster">
    <button class="absolute top-3 right-4 text-slate-400 hover:text-red-500 text-xl" onclick="closeNotificationModal()">×</button>
    <h2 id="notifTitle" class="text-2xl font-bold text-indigo-800 dark:text-white mb-3"></h2>
    <p id="notifMessage" class="text-slate-700 dark:text-slate-300 text-base mb-4 leading-relaxed"></p>
    <p id="notifTime" class="text-xs text-slate-500"></p>
    <button id="markAsReadBtn" class="mt-5 px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-full shadow-lg transition">Mark as Read</button>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<script>
let currentNotifId = null;

function openNotificationModal(data) {
  document.getElementById('notifTitle').textContent = data.title;
  document.getElementById('notifMessage').textContent = data.message;
  document.getElementById('notifTime').textContent = data.time;
  currentNotifId = data.id;

  document.getElementById('notificationModal').classList.remove('hidden');
  document.getElementById('notificationModal').classList.add('flex');
}

function closeNotificationModal() {
  document.getElementById('notificationModal').classList.remove('flex');
  document.getElementById('notificationModal').classList.add('hidden');
}

function markAllAsRead() {
  fetch(`/notifications/mark-all-as-read`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json'
    }
  }).then(() => location.reload());
}

document.getElementById('markAsReadBtn').addEventListener('click', function () {
  if (!currentNotifId) return;

  fetch(`/notifications/${currentNotifId}/mark-as-read`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json'
    }
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      document.getElementById(`notif-card-${currentNotifId}`)?.classList.remove('bg-white');
      document.getElementById(`notif-card-${currentNotifId}`)?.classList.add('bg-slate-100', 'dark:bg-darkmode-700');
      closeNotificationModal();

      // Hide the main bell dot if no unread left
      fetch('/notifications').then(res => res.json()).then(notifs => {
        if (!notifs.some(n => !n.read_at)) {
          document.getElementById('mainBellDot')?.remove();
        }
      });
    }
  })
  .catch(error => console.error('Mark as read failed:', error));
});
</script>












<!-- END: Notifications -->

    <!-- BEGIN: Account Menu -->
 <div class="intro-x dropdown w-8 h-8">
        @php
        $user_id = auth()->user()->id;
        $student = \App\Models\Students::where('user_id',$user_id)->first();
    @endphp
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            @if(auth()->user()->user_type == 'super-admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
          <img alt="IMS Scholarship" src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('dist/images/profile-10.jpg') }}">

            @endif
             @if(auth()->user()->user_type == 'student')
            <img alt="IMS Scholarship" src="{{ isset($student) ? asset($student->image_path) : asset('dist/images/profile-10.jpg') }}">
            @endif
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{ auth()->user()->name }}</div>

                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <a href="{{ route('basic-info-profile') }}" class="dropdown-item hover:bg-white/5">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                    </a>
                </li>

                <li>
                    <a href="{{ route('updatePassword') }}" class="dropdown-item hover:bg-white/5">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Change Password
                    </a>
                </li>

                <li><hr class="dropdown-divider border-white/[0.08]"></li>
                <li>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item hover:bg-white/5">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>

<!-- END: Top Bar -->

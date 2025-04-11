<h2 class="font-medium text-lg">
    {{ $institution ? strtoupper($institution->name) : 'Institution Name Not Available' }}
</h2>
<p><strong>Country:</strong> {{ $institution && $institution->country ? \App\Models\Countries::find($institution->country)->name : 'N/A' }}</p>
<p><strong>Province:</strong> {{ $institution && $institution->province ? $institution->province : 'N/A' }}</p>
<p><strong>City:</strong> {{ $institution && $institution->city ? $institution->city : 'N/A' }}</p>
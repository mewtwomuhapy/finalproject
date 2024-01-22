<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดี, {{Auth::user()->name}}

          <b class="float-end"> จำนวนผู้ใช้ระบบ <span>{{count($users)}}</span> คน </b>
        </h2>
    </x-slot>

</table>
   </div>
    </div>
</x-app-layout>

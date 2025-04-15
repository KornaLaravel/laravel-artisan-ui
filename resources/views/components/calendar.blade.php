@props([ 'selected' => '', 'mode' => 'single' , 'onselect' => '', "max" => null, "min" => null, "disabled" => null,
"required" => false ])
<div x-data='calendar(@json($selected), "{{$mode}}", @json($disabled) , @json($min), @json($max), @json($required))'
    x-bind="root" {{$attributes->
    class([' p-4
    antialiased bg-background border-input border rounded-lg shadow w-[19rem] min-h-[19rem]'])}}
    x-modelable="modeHandler.value">
    <div class="flex items-center justify-between mb-3">
        <button x-bind="previousMonthTrigger" type="button"
            class="border dark:border-input inline-flex p-1 transition duration-100 ease-in-out rounded-lg focus:shadow-outline hover:bg-gray-100 dark:hover:bg-transparent/10">
            <x-aui::angle-down class="inline-flex w-6 h-6 fill-foreground rotate-90" />
        </button>
        <div>
            <span x-bind="monthLabel" class="text-lg font-bold text-gray-800 dark:text-gray-100"></span>
            <span x-bind="yearLabel" class="ml-1 text-lg font-normal text-gray-600 dark:text-gray-100"></span>
        </div>
        <button x-bind="nextMonthTrigger" type="button"
            class="border dark:border-border inline-flex p-1 transition duration-100 ease-in-out rounded-lg focus:shadow-outline hover:bg-gray-100 dark:hover:bg-transparent/10">
            <x-aui::angle-down class="inline-flex w-6 h-6 fill-foreground -rotate-90" />
        </button>
    </div>
    {{--display days of the week--}}
    <div class="grid grid-cols-7 mb-3">
        <template x-for="(day, index) in days">
            <div class="px-0.5">
                <div x-text="day" class="text-xs font-medium text-center text-gray-800 dark:text-gray-100"></div>
            </div>
        </template>
    </div>
    <div class="grid grid-cols-7">
        <template x-for="blankDay in preBlankDaysInMonth">
            <div x-text="blankDay"
                x-effect="focusedDay == blankDay && ($root.contains($focus.focused())) && $el.focus({preventScroll: true})"
                class="text-muted-foreground opacity-50 flex items-center justify-center text-sm leading-none text-center rounded-md cursor-pointer px-0.5 aspect-square w-auto focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring focus-visible:ring-offset-1">
            </div>
        </template>
        <template x-for="(day, dayIndex) in daysInMonth" :key="dayIndex">
            <button tabindex="-1" type="button"
                x-effect="focusedDay == day && ($root.contains($focus.focused()))  && $el.focus({preventScroll: true})"
                x-text="day" :disabled="isDisabled(new Date(year, month, day))" @click="dayClicked(day);" :class="{
                        'bg-accent text-accent-foreground': isToday(day) == true && isSelectedDay(day) == false && !isDisabled(new Date(year, month, day)),
                        'text-foreground hover:bg-accent': isToday(day) == false && isSelectedDay(day) == false && !isDisabled(new Date(year, month, day)),
                        'bg-primary text-primary-foreground hover:bg-primary hover:text-primary-foreground focus:bg-primary focus:text-primary-foreground' : isSelectedDay(day) == true && !isDisabled(new Date(year, month, day)),
                        'text-muted-foreground opacity-50 aria-selected:bg-accent/50 aria-selected:text-muted-foreground aria-selected:opacity-30': isDisabled(new Date(year, month, day)),
                        'border-black dark:border-white' : isFocusedDate(day),
                        'bg-accent text-accent-foreground' : isRangeMiddle(new Date(year, month, day)),
                    }"
                class="flex items-center justify-center text-sm leading-none text-center rounded-md cursor-pointer px-0.5 aspect-square w-auto focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring focus-visible:ring-offset-1">
            </button>
        </template>
        <template x-for="blankDay in postBlankDaysInMonth">
            <div x-text="blankDay"
                x-effect="focusedDay == blankDay && ($root.contains($focus.focused())) && $el.focus({preventScroll: true})"
                class="text-muted-foreground opacity-50 flex items-center justify-center text-sm leading-none text-center rounded-md cursor-pointer px-0.5 aspect-square w-auto focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring focus-visible:ring-offset-1">
            </div>
        </template>
    </div>
</div>

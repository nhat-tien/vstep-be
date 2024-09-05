<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        <audio controls>
            <source src="{{ "/storage/" . $getRecord()->url }}" type="audio/mpeg" />
        </audio>
    </div>
</x-dynamic-component>

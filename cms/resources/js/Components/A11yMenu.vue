<script setup>
import { ref, onMounted } from 'vue';

const menu = ref(false);

const options = ref([
    {
        key: 'font-size',
        label: 'Povećaj font',
        iconPath: 'M256 200v16c0 4.25-3.75 8-8 8h-56v56c0 4.25-3.75 8-8 8h-16c-4.25 0-8-3.75-8-8v-56h-56c-4.25 0-8-3.75-8-8v-16c0-4.25 3.75-8 8-8h56v-56c0-4.25 3.75-8 8-8h16c4.25 0 8 3.75 8 8v56h56c4.25 0 8 3.75 8 8zM288 208c0-61.75-50.25-112-112-112s-112 50.25-112 112 50.25 112 112 112 112-50.25 112-112zM416 416c0 17.75-14.25 32-32 32-8.5 0-16.75-3.5-22.5-9.5l-85.75-85.5c-29.25 20.25-64.25 31-99.75 31-97.25 0-176-78.75-176-176s78.75-176 176-176 176 78.75 176 176c0 35.5-10.75 70.5-31 99.75l85.75 85.75c5.75 5.75 9.25 14 9.25 22.5z',
        active: false,
    },
    {
        key: 'grayscale',
        label: 'Sivi tonovi',
        iconPath: 'M15.75 384h-15.75v-352h15.75v352zM31.5 383.75h-8v-351.75h8v351.75zM55 383.75h-7.75v-351.75h7.75v351.75zM94.25 383.75h-7.75v-351.75h7.75v351.75zM133.5 383.75h-15.5v-351.75h15.5v351.75zM165 383.75h-7.75v-351.75h7.75v351.75zM180.75 383.75h-7.75v-351.75h7.75v351.75zM196.5 383.75h-7.75v-351.75h7.75v351.75zM235.75 383.75h-15.75v-351.75h15.75v351.75zM275 383.75h-15.75v-351.75h15.75v351.75zM306.5 383.75h-15.75v-351.75h15.75v351.75zM338 383.75h-15.75v-351.75h15.75v351.75zM361.5 383.75h-15.75v-351.75h15.75v351.75zM408.75 383.75h-23.5v-351.75h23.5v351.75zM424.5 383.75h-8v-351.75h8v351.75zM448 384h-15.75v-352h15.75v352z',
        reset: ['high-contrast', 'negative-contrast', 'highlight-links'],
        active: false,
    },
    {
        key: 'high-contrast',
        label: 'Visoki kontrast',
        iconPath: 'M192 360v-272c-75 0-136 61-136 136s61 136 136 136zM384 224c0 106-86 192-192 192s-192-86-192-192 86-192 192-192 192 86 192 192z',
        reset: ['grayscale', 'negative-contrast', 'highlight-links'],
        active: false,
    },
    {
        key: 'negative-contrast',
        label: 'Negativan kontrast',
        iconPath: 'M416 240c-23.75-36.75-56.25-68.25-95.25-88.25 10 17 15.25 36.5 15.25 56.25 0 61.75-50.25 112-112 112s-112-50.25-112-112c0-19.75 5.25-39.25 15.25-56.25-39 20-71.5 51.5-95.25 88.25 42.75 66 111.75 112 192 112s149.25-46 192-112zM236 144c0-6.5-5.5-12-12-12-41.75 0-76 34.25-76 76 0 6.5 5.5 12 12 12s12-5.5 12-12c0-28.5 23.5-52 52-52 6.5 0 12-5.5 12-12zM448 240c0 6.25-2 12-5 17.25-46 75.75-130.25 126.75-219 126.75s-173-51.25-219-126.75c-3-5.25-5-11-5-17.25s2-12 5-17.25c46-75.5 130.25-126.75 219-126.75s173 51.25 219 126.75c3 5.25 5 11 5 17.25z',
        reset: ['grayscale', 'high-contrast', 'highlight-links'],
        active: false,
    },
    {
        key: 'highlight-links',
        label: 'Naglasi poveznice',
        iconPath: 'M364 304c0-6.5-2.5-12.5-7-17l-52-52c-4.5-4.5-10.75-7-17-7-7.25 0-13 2.75-18 8 8.25 8.25 18 15.25 18 28 0 13.25-10.75 24-24 24-12.75 0-19.75-9.75-28-18-5.25 5-8.25 10.75-8.25 18.25 0 6.25 2.5 12.5 7 17l51.5 51.75c4.5 4.5 10.75 6.75 17 6.75s12.5-2.25 17-6.5l36.75-36.5c4.5-4.5 7-10.5 7-16.75zM188.25 127.75c0-6.25-2.5-12.5-7-17l-51.5-51.75c-4.5-4.5-10.75-7-17-7s-12.5 2.5-17 6.75l-36.75 36.5c-4.5 4.5-7 10.5-7 16.75 0 6.5 2.5 12.5 7 17l52 52c4.5 4.5 10.75 6.75 17 6.75 7.25 0 13-2.5 18-7.75-8.25-8.25-18-15.25-18-28 0-13.25 10.75-24 24-24 12.75 0 19.75 9.75 28 18 5.25-5 8.25-10.75 8.25-18.25zM412 304c0 19-7.75 37.5-21.25 50.75l-36.75 36.5c-13.5 13.5-31.75 20.75-50.75 20.75-19.25 0-37.5-7.5-51-21.25l-51.5-51.75c-13.5-13.5-20.75-31.75-20.75-50.75 0-19.75 8-38.5 22-52.25l-22-22c-13.75 14-32.25 22-52 22-19 0-37.5-7.5-51-21l-52-52c-13.75-13.75-21-31.75-21-51 0-19 7.75-37.5 21.25-50.75l36.75-36.5c13.5-13.5 31.75-20.75 50.75-20.75 19.25 0 37.5 7.5 51 21.25l51.5 51.75c13.5 13.5 20.75 31.75 20.75 50.75 0 19.75-8 38.5-22 52.25l22 22c13.75-14 32.25-22 52-22 19 0 37.5 7.5 51 21l52 52c13.75 13.75 21 31.75 21 51z',
        active: false,
    },
    {
        key: 'reset',
        label: 'Resetiraj',
        iconPath: 'M384 224c0 105.75-86.25 192-192 192-57.25 0-111.25-25.25-147.75-69.25-2.5-3.25-2.25-8 0.5-10.75l34.25-34.5c1.75-1.5 4-2.25 6.25-2.25 2.25 0.25 4.5 1.25 5.75 3 24.5 31.75 61.25 49.75 101 49.75 70.5 0 128-57.5 128-128s-57.5-128-128-128c-32.75 0-63.75 12.5-87 34.25l34.25 34.5c4.75 4.5 6 11.5 3.5 17.25-2.5 6-8.25 10-14.75 10h-112c-8.75 0-16-7.25-16-16v-112c0-6.5 4-12.25 10-14.75 5.75-2.5 12.75-1.25 17.25 3.5l32.5 32.25c35.25-33.25 83-53 132.25-53 105.75 0 192 86.25 192 192z',
        reset: ['font-size', 'grayscale', 'high-contrast', 'negative-contrast', 'highlight-links']
    }
]);

const loadOptions = () => {
    const activeOptionKeys = JSON.parse(localStorage.getItem('a11y-options')) || [];

    for(const activeOptionKey of activeOptionKeys) {
        const optionIndex = options.value.findIndex((option) => option.key === activeOptionKey);
        toggleOption(optionIndex);
    }
};

const toggleOption = (optionIndex) => {
    const option = options.value[optionIndex];

    if(option.reset) {
        for(const resetOptionKey of option.reset) {
            const resetOptionIndex = options.value.findIndex((option) => option.key === resetOptionKey);
            const resetOption = options.value[resetOptionIndex];
            resetOption.active = false;
            document.body.classList.remove(`a11y-${resetOption.key}`);
        }

        if(option.key === 'reset') {
            return;
        }
    }

    option.active = !option.active;

    document.body.classList.toggle(`a11y-${option.key}`);

    const activeOptionKeys = options.value.filter((option) => option.active).map((option) => option.key);
    localStorage.setItem('a11y-options', JSON.stringify(activeOptionKeys));
};

onMounted(() => loadOptions());
</script>

<template>
    <div :class="`fixed left-0 top-32 z-1 ${menu ? 'left-0' : 'left-[-200px]'}`" style="z-index: 1; transition: left 750ms cubic-bezier(.23, 1, .32, 1);">
        <nav role="navigation">
            <div class="absolute left-[200px] flex justify-center items-center bg-primary-700 text-white">
                <button type="button" title="Pristupačnost" class="p-2.5" @click="menu = !menu" :tabindex="menu ? 0 : -1">
                    <span class="sr-only">
                        Otvori izbornik za pristupačnost
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="currentColor" width="2em">
                        <title>Pristupačnost</title>
                        <path d="M50 8.1c23.2 0 41.9 18.8 41.9 41.9 0 23.2-18.8 41.9-41.9 41.9C26.8 91.9 8.1 73.2 8.1 50S26.8 8.1 50 8.1M50 0C22.4 0 0 22.4 0 50s22.4 50 50 50 50-22.4 50-50S77.6 0 50 0zm0 11.3c-21.4 0-38.7 17.3-38.7 38.7S28.6 88.7 50 88.7 88.7 71.4 88.7 50 71.4 11.3 50 11.3zm0 8.9c4 0 7.3 3.2 7.3 7.3S54 34.7 50 34.7s-7.3-3.2-7.3-7.3 3.3-7.2 7.3-7.2zm23.7 19.7c-5.8 1.4-11.2 2.6-16.6 3.2.2 20.4 2.5 24.8 5 31.4.7 1.9-.2 4-2.1 4.7-1.9.7-4-.2-4.7-2.1-1.8-4.5-3.4-8.2-4.5-15.8h-2c-1 7.6-2.7 11.3-4.5 15.8-.7 1.9-2.8 2.8-4.7 2.1-1.9-.7-2.8-2.8-2.1-4.7 2.6-6.6 4.9-11 5-31.4-5.4-.6-10.8-1.8-16.6-3.2-1.7-.4-2.8-2.1-2.4-3.9.4-1.7 2.1-2.8 3.9-2.4 19.5 4.6 25.1 4.6 44.5 0 1.7-.4 3.5.7 3.9 2.4.7 1.8-.3 3.5-2.1 3.9z"></path>
                    </svg>
                </button>
            </div>
            <div class="bg-white w-[200px]">
                <p class="font-medium px-4 py-3">
                    Pristupačnost
                </p>
                <ul class="text-sm">
                    <li v-for="(option, index) in options" :key="option.key" :class="`px-4 py-2 ${option.active ? 'bg-primary-700 text-white' : ''}`">
                        <button @click="toggleOption(index)" class="flex items-center gap-3 hover:opacity-80" type="button" tabindex="0">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" viewBox="0 0 448 448">
                                <title>
                                    {{ option.label }}
                                </title>
                                <path fill="currentColor" :d="option.iconPath"></path>
                            </svg>
                            {{ option.label }}
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<style>
.a11y-grayscale {
    filter: grayscale(100%) !important;
}

.a11y-high-contrast {
    filter: contrast(200%) !important;
}

.a11y-negative-contrast {
    filter: invert(100%) !important;
}

.a11y-highlight-links a {
    text-decoration: underline;
}

/* smh, not the way.. */

.a11y-font-size .text-xs, .a11y-font-size .\sm\:text-xs, .a11y-font-size .\md\:text-xs, .a11y-font-size .\lg\:text-xs, .a11y-font-size .\xl\:text-xs {
	font-size: 0.875rem;
    line-height: 1.25rem;
}

.a11y-font-size .text-sm, .a11y-font-size .\sm\:text-sm, .a11y-font-size .\md\:text-sm, .a11y-font-size .\lg\:text-sm, .a11y-font-size .\xl\:text-sm {
	font-size: 1rem;
    line-height: 1.5rem;
}

.a11y-font-size .text-base, .a11y-font-size .\sm\:text-base, .a11y-font-size .\md\:text-base, .a11y-font-size .\lg\:text-base, .a11y-font-size .\xl\:text-base {
    font-size: 1.125rem;
    line-height: 1.75rem;
}

.a11y-font-size .text-lg, .a11y-font-size .\sm\:text-lg, .a11y-font-size .\md\:text-lg, .a11y-font-size .\lg\:text-lg, .a11y-font-size .\xl\:text-lg {
    font-size: 1.25rem;
    line-height: 1.75rem;
}

.a11y-font-size .text-xl, .a11y-font-size .\sm\:text-xl, .a11y-font-size .\md\:text-xl, .a11y-font-size .\lg\:text-xl, .a11y-font-size .\xl\:text-xl {
    font-size: 1.5rem;
    line-height: 2rem;
}

.a11y-font-size .text-2xl, .a11y-font-size .\sm\:text-2xl, .a11y-font-size .\md\:text-2xl, .a11y-font-size .\lg\:text-2xl, .a11y-font-size .\xl\:text-2xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
}

.a11y-font-size .text-3xl, .a11y-font-size .\sm\:text-3xl, .a11y-font-size .\md\:text-3xl, .a11y-font-size .\lg\:text-3xl, .a11y-font-size .\xl\:text-3xl {
    font-size: 2.25rem;
    line-height: 2.5rem;
}

.a11y-font-size .text-4xl, .a11y-font-size .\sm\:text-4xl, .a11y-font-size .\md\:text-4xl, .a11y-font-size .\lg\:text-4xl, .a11y-font-size .\xl\:text-4xl {
    font-size: 3rem;
    line-height: 1;
}

.a11y-font-size .text-5xl, .a11y-font-size .\sm\:text-5xl, .a11y-font-size .\md\:text-5xl, .a11y-font-size .\lg\:text-5xl, .a11y-font-size .\xl\:text-5xl {
    font-size: 3.75rem;
    line-height: 1;
}

.a11y-font-size .text-6xl, .a11y-font-size .\sm\:text-6xl, .a11y-font-size .\md\:text-6xl, .a11y-font-size .\lg\:text-6xl, .a11y-font-size .\xl\:text-6xl {
    font-size: 4.5rem;
    line-height: 1;
}

.a11y-font-size .text-7xl, .a11y-font-size .\sm\:text-7xl, .a11y-font-size .\md\:text-7xl, .a11y-font-size .\lg\:text-7xl, .a11y-font-size .\xl\:text-7xl {
    font-size: 6rem;
    line-height: 1;
}

.a11y-font-size .text-8xl, .a11y-font-size .\sm\:text-8xl, .a11y-font-size .\md\:text-8xl, .a11y-font-size .\lg\:text-8xl, .a11y-font-size .\xl\:text-8xl {
    font-size: 8rem;
    line-height: 1;
}

.a11y-font-size .text-9xl, .a11y-font-size .\sm\:text-9xl, .a11y-font-size .\md\:text-9xl, .a11y-font-size .\lg\:text-9xl, .a11y-font-size .\xl\:text-9xl {
    font-size: 9rem;
    line-height: 1;
}

.a11y-font-size .format {
    font-size: 125%;
}
</style>
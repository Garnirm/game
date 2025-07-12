<template>
    <svg width="32" height="32" viewBox="0 0 100 87" :style="style" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="greenTriangleGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#A8E063;" />
            <stop offset="100%" style="stop-color:#56AB2F;" />
            </linearGradient>
        </defs>
        
        <polygon points="50,0 100,87 0,87" fill="url(#greenTriangleGradient)" />
    </svg>
</template>

<script>
export default {
    props: [ 'orientation' ],

    computed: {
        style: function () {
            if (typeof this.orientation !== 'undefined') {
                return {
                    transform: 'rotate('+this.orientation+'deg)'
                }
            }
        },
    },
}
</script>
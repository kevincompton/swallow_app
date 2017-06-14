<script>
import Vue from 'vue';

export default {

    template: '#autocomplete-input-template',

    data () {
        return {
            isOpen: false,
            highlightedPosition: 0,
            keyword: ''
        }
    },

    props: {
        options: {
            type: Array,
            required: true
        }
    },

    computed: {
        fOptions () {
            const re = new RegExp(this.keyword, 'i')
            return this.options.filter(o => o.title.match(re)) 
        }
    },

    methods: {

        onInput (value) {
            this.isOpen = !!value
            this.highlightedPosition = 0
        },

        moveDown () {
            if (!this.isOpen) {
                return
            }
            this.highlightedPosition = (this.highlightedPosition + 1) % this.fOptions.length;
        },

        moveUp () {
          if (!this.isOpen) {
            return
          }
          this.highlightedPosition = this.highlightedPosition - 1 < 0
            ? this.fOptions.length - 1
            : this.highlightedPosition - 1;
        },

        select () {
          const selectedOption = this.fOptions[this.highlightedPosition]
          this.keyword = selectedOption.title
          this.isOpen = false
          this.$emit('select', selectedOption)
        }

    }
}

</script>

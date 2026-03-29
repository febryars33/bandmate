// resources/js/composables/useSafeHtml.ts
import DOMPurify from 'dompurify'

const ALLOWED_TAGS = ['p', 'span', 'b', 'strong', 'a', 'em', 'i', 'br']
const ALLOWED_ATTR = ['href', 'title', 'rel', 'target']

// Paksa semua anchor ke _blank + noopener
DOMPurify.addHook('afterSanitizeAttributes', (node) => {
    if (node.tagName === 'A') {
        node.setAttribute('target', '_blank')
        node.setAttribute('rel', 'noopener noreferrer nofollow')
    }
})

export function useSafeHtml() {
    const sanitize = (html: string): string => {
        if (!html) return ''

        return DOMPurify.sanitize(html, {
            ALLOWED_TAGS,
            ALLOWED_ATTR,
            ALLOW_DATA_ATTR: false,   // blokir data-* attributes
            FORBID_SCRIPTS: true,
            FORBID_TAGS: ['style', 'form', 'input'],
        })
    }

    return { sanitize }
}

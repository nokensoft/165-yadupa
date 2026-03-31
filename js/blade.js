/**
 * blade.js - Simulasi Laravel Blade @include() untuk Alpine.js
 *
 * Penggunaan di HTML:
 *   <div x-data x-include="partials.header"></div>
 *
 * Sama seperti Laravel:
 *   @include('partials.header')
 *
 * File akan di-fetch dari folder views/, contoh:
 *   partials.header → views/partials/header.html
 */
document.addEventListener('alpine:init', () => {
    Alpine.directive('include', (el, { expression }) => {
        let path = expression.replace(/\./g, '/')

        fetch(`views/${path}.html`)
            .then(r => {
                if (!r.ok) throw new Error(`View [${expression}] not found.`)
                return r.text()
            })
            .then(html => {
                el.innerHTML = html
                Alpine.initTree(el)
            })
            .catch(e => {
                console.error(`[Blade] ${e.message}`)
            })
    })
})

export let pages = []

export function add(atribute){
  pages.push(atribute)
}

export function get(atribute){
  return pages.includes(atribute)
}

export function getAll(){
  return pages
}

export function clearAndGetAll(){
  let page = []
  pages = page

  return pages
}

export function remove(page){
  let index = pages.indexOf(page)
  // pages.splice(0, 1)
  // console.log(pages)
  pages.splice(index, 1)

  return get(page, 'tem')

}

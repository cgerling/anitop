let id = 1;

const api = {
    base: "http://jikan.me/api", 
    anime: "anime"
}

const animeService = {
    getAnime(id = 0) {
        return fetch(`${api.base}/${api.anime}/${id}`).then(response => response.json())
    }
}

const queryService = {
    createInsert(table = '', fields = [], values = []) {
        return `INSERT INTO ${table.toLowerCase()}(${fields.join(',')}) VALUES (${values.map(value => value.replace(/&quot;/g, '\\\'')).join(',')})`
    }
}

function animeToInsert (data) {
	const table = 'anime'
	const fields = ['name', 'description', 'studio', 'publisher', 'image']
	const anime = {
		name: data.title,
		description: data.synopsis,
		studio: data.studio.join(', '),
		publisher: data.licensor ? data.licensor.join(', ') : '',
		image: data.image
	}

	const values = Object.keys(anime).map(key => JSON.stringify(anime[key]))
	return queryService.createInsert(table, fields, values)
}

const DOMService = {
    appendLine(text) {
        const body = document.body;
        body.innerHTML += `${text.trim()} <br>`
    }
}

function appendAnimeSQL(id) {
	return animeService.getAnime(id).then(animeToInsert).then(DOMService.appendLine)
}

function recursiveAppendAnimeSQL(id) {
	if(id >= 10000) return;

	const callback = () => {
		console.info(id)
		recursiveAppendAnimeSQL(++id)
	}

	return appendAnimeSQL(id).then(callback).catch(callback)
}
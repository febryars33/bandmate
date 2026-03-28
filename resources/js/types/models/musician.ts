import type { Genre } from "./genre";
import type { Instrument } from "./instrument";
import type { ArtistMusician } from "./pivots/artist_musician";
import type { User } from "./user";

export type Musician<T = ArtistMusician> = {
    id: number
    stage_name: string
    real_name: string
    bio: string | null
    about: string | null
    social_links: string[]
    gender: string
    birth_place: string
    instruments: Instrument[]
    genres: Genre[]
    few_instruments?: Instrument[]
    few_genre?: Genre[]
    user?: User | null
    pivot?: T
};

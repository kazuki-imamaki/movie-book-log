import Authenticated from "../Layouts/Authenticated";
import { Head } from "@inertiajs/react";
import { router } from "@inertiajs/react";

const ImageResults = (props: any) => {
    const passMovieValue = (e: any) => {
        console.log(props.results[e.target.id]);
        const url = route("want.movie.index");
        router.get(url, [props.results[e.target.id], props.keepValue]);
    };
    return (
        <Authenticated auth={props.auth}>
            <Head title="画像検索" />
            <>
                {props.results.map((result, index) => (
                    <div className="flex" key={index}>
                        <button>
                            <img
                                onClick={passMovieValue}
                                id={index}
                                src={result.poster_path}
                                alt=""
                            />
                        </button>
                        <h2>{result.title}</h2>
                    </div>
                ))}
            </>
        </Authenticated>
    );
};
export default ImageResults;

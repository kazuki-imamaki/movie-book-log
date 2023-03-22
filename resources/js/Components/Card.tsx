const Card = (props) => {
    console.log(props);
    return (
        <>
            <section className="body-font text-white bg-gray-900">
                <div className="container px-5 py-24 mx-auto">
                    <div className="flex flex-wrap -m-4">
                        {props.contents.map((content: any, index: number) => (
                            <div key={index} className="p-4 w-1/5">
                                <div className="h-full border-none border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-gray-800">
                                    {/* <Link
                                            href={route(
                                                "want.movie.update.index",
                                                { id: movie.id }
                                            )}
                                        > */}
                                    <img
                                        className="lg:h-80 md:h-60 w-full object-cover object-center"
                                        src={content.poster_path}
                                        alt="blog"
                                        // onClick={getToEdit}
                                        id={content.id}
                                    />
                                    {/* </Link> */}
                                    <div className="p-6">
                                        <h2 className="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                            MOVIE
                                        </h2>
                                        <h1 className="title-font text-lg font-medium text-white mb-3">
                                            {content.title}
                                        </h1>
                                        <p className="leading-relaxed mb-3 text-xs text-slate-300">
                                            {content.memo}
                                        </p>
                                        {/* {doneFlag && (
                                            <div className="[&>span]:flex">
                                                <p className="text-xs">
                                                    {content.date}
                                                </p>
                                                <StarRating
                                                    isEdit="false"
                                                    size="15"
                                                    value={content.star}
                                                />
                                            </div>
                                        )} */}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </>
    );
};
export default Card;

using backend.Data.Entities.Owned;

namespace backend.Models.Responses;

public class CreateItemTagResponse
{
    public int Id { get; set; }

    public string Name { get; set; }
    public string Description { get; set; }

    public string Token { get; set; }

    public IEnumerable<ItemTagFieldGroup> FieldGroups { get; set; }
}